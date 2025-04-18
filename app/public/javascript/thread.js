async function createThread(user_id, board_id) {
    const formData = {
        title: document.getElementById('threadTitle').value,
        first_post: document.getElementById('firstPost').value,
        tags: document.getElementById('tags').value.split(',').map(tag => tag.trim())
    };

    if (formData.title === '' || formData.first_post === '') {
        displayError('Title and first post are required');
        return;
    }

    try {
        const threadData = await createNewThread(board_id, formData.title, formData.first_post, user_id);
        if (!threadData || !threadData.thread) {
            console.error('Thread not found:', threadData);
            return;
        }
        await updateThreadCount(board_id, 1)


        if (formData.tags && formData.tags.length > 0 && formData.tags[0] !== '') {
            await addTags(threadData.thread.thread_id, formData.tags)
                .then((tagData) => {
                    if (!tagData || !tagData.thread_id || !tagData.tags) {
                        console.error('Tags not found:', tagData);
                        return;
                    }
                    return addThreadTags(tagData.thread_id, tagData.tags);
                })
        }
        await createFirstPost(threadData.thread.thread_id, threadData.thread.first_post, threadData.thread.user_id);
        await updatePostCount(threadData.thread.thread_id, 1)
        window.location.href = `http://localhost/board/${board_id}`;
    } catch (error) {
        console.error('Error:', error.message, 'Stack:', error.stack);
    }
}
async function updateThreadCount(board_id, threadCountChange)
{
    const response = await fetch(`http://localhost/api/board/updateThreadCount?board_id=${board_id}`,
        {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                thread_count: threadCountChange
            })
        })
    if (!response.ok) {
        const error = await response.text();
        console.log(error);
        throw new Error('Failed to update thread count');
    }
    console.log('Thread count updated successfully');
}
async function createNewThread(board_id, title, first_post, user_id) 
{
    try
    {
        const response = await fetch('http://localhost/api/thread', {
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
            await response.text();
            console.log('Failed to create thread');
        }
        console.log('Thread created');
        return await response.json();

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
                message: first_post,
                user_id: user_id
            })
        });
        if (!response.ok) {
            const error = await response.text();
            console.log(error);
            throw new Error('Failed to create first post');
        }
        await response.json();
        console.log('First Post');

    }
    catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
async function addTags(thread_id, tags) {
    const tagData = await GetTags('tag', thread_id, tags);
    console.log('New tags added:', tagData);
    return tagData;
}

async function addThreadTags(thread_id, thread_tags) {
    const threadTags = await GetTags('threadtag', thread_id, thread_tags);
    console.log('Tags added to thread:', threadTags);
}
async function GetTags(url, thread_id, tags) {
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