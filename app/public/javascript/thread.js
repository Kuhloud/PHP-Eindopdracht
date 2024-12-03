function createThread(user_id, board_id) {

    const formData = {
        title: document.getElementById('threadTitle').value,
        first_post: document.getElementById('firstPost').value,
        tags: document.getElementById('tags').value.split(',').map(tag => tag.trim())
    };
    if (formData.title == '' || formData.first_post == '') {
        displayError('Title and first post are required');
        return;
    }
    createNewThread(board_id, formData.title, formData.first_post, user_id)
    .then((threadData) => {
        if (!threadData || !threadData.thread) {
            console.error('Thread not found:', threadData);
            return;
        }
        let promises = [];
        if (formData.tags && formData.tags.length > 0 && formData.tags[0] != '') 
        {
            promises.push(
            addTags(threadData.thread.thread_id, formData.tags)
            .then((tagData) => {
                if (!tagData || !tagData.thread_id || !tagData.tags) {
                    console.error('Tags not found:', tagData);
                    return;
                }
                return addThreadTags(tagData.thread_id, tagData.tags);
            })
        );
        }
        promises.push(createFirstPost(threadData.thread.thread_id, threadData.thread.first_post, threadData.thread.user_id));
        return Promise.all(promises);
    })
    .then(() => 
    {
        window.location.href = `http://localhost/board/${board_id}`;
    })
    .catch(error => {
        console.error('Error:', error.message, 'Stack:', error.stack);
    });
}
async function createNewThread(board_id, title, first_post, user_id) 
{
    try
    {
        const response = await fetch('http://localhost/api/post', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                board_id: board_id,
                title: title,
                first_post: first_post,
                user_id: user_id
            })
        })
        if (!response.ok) {
            const error = await response.text();
            console.log(error);
            throw new Error('Failed to create thread');
        }
        const data = await response.json();
        console.log('Thread created:', data);
        return data;

    }
    catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
async function createFirstPost(thread_id, first_post, user_id) {
    try{
        const response = await fetch('http://localhost/api/post', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                thread_id: thread_id,
                first_post: first_post,
                user_id: user_id
            })
        });
        if (!response.ok) {
            const error = await response.text();
            console.log(error);
            throw new Error('Failed to create first post');
        }
        const data = await response.json();
        console.log('First Post:', data);

    }
    catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
async function addTags(thread_id, tags) {
    const tagData = await processTags('tag', thread_id, tags);
    console.log('New tags added:', tagData);
    return tagData;
}

async function addThreadTags(thread_id, thread_tags) {
    const threadTags = await processTags('threadtag', thread_id, thread_tags);
    console.log('Tags added to thread:', threadTags);
}
async function processTags(url, thread_id, tags) {
    try {
        const response = await fetch(`http://localhost/api/${url}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(
                {
                    thread_id: thread_id,
                    tags: tags
                }
            )
        });
        if (!response.ok) {
            const error = await response.text();
            console.log(error);
            throw new Error(`Failed to post data to ${url}`);
        }
        return await response.json();
    } catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
function displayError(error) {
    const form = document.getElementById('createThread');
    const errorDisplay = document.createElement('p');
    errorDisplay.classList.add('alert', 'alert-danger');
    errorDisplay.innerText = error;
    form.appendChild(errorDisplay);
}