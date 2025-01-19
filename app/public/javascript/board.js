document.addEventListener('DOMContentLoaded', () => {
    const url = window.location.href;
    const segments = url.split('/');
    const board_id = segments[segments.length - 1];
    loadThreads(board_id);
});
async function loadThreads(board_id) {
    try {
        const threads = await getThreads(board_id);
        threads.sort((a, b) => Date.parse(a.created_at) - Date.parse(b.created_at));
        await Promise.all(threads.map(async thread => {
                const tags = await getTags(thread.thread_id);
                const username = await getUser(thread.user_id);
                const a = document.createElement('a');
                a.setAttribute('href', `/thread/${thread.thread_id}`);
                a.classList.add('clickable-card');
                a.id = 'thread';
    
                const section = document.createElement('section');
                section.classList.add('card');
    
                const article = document.createElement('article');
                article.classList.add('card-body', 'd-flex', 'flex-column');
    
                const threadTitle = document.createElement('h4');
                threadTitle.classList.add('card-title');
                threadTitle.innerText = thread.title;
    
                const threadDescription = document.createElement('p');
                threadDescription.classList.add('card-text');
                threadDescription.innerText = thread.first_post;
    
                const numberOfPosts = document.createElement('small');
                numberOfPosts.classList.add('card-subtitle', 'mb-2', 'text-muted');
                numberOfPosts.innerText = `Number of Posts: ${thread.post_count}` ;

                const dateOfCreation = document.createElement('small');
                dateOfCreation.classList.add('card-subtitle', 'mb-2', 'text-muted');
                dateOfCreation.innerText = `Created at: ${thread.created_at}` ;
    
                const user = document.createElement('small');
                user.classList.add('card-subtitle', 'mb-2', 'text-muted');
                user.innerText = username;

                article.appendChild(threadTitle);
                article.appendChild(threadDescription);
                article.appendChild(numberOfPosts);
                article.appendChild(dateOfCreation);
                article.appendChild(user);

                if (Array.isArray(tags)) {
                    const tagList = createTagList(tags);
                    article.appendChild(tagList);
                }

                section.appendChild(article);
                a.appendChild(section);

                const element = document.getElementById('threads');
                element.appendChild(a);
                if (userRole === 3 || userRole === 2)
                {
                    const deleteButton = createDeleteButton();
                    deleteButton.addEventListener('click', async function() {
                        await updatePostCount(thread.thread_id, -1)
                        await deleteThread(thread.thread_id);
                        await updateThreadCount(board_id, -1)
                        const threadElement = this.parentNode;
                        threadElement.remove();
                    });
                    element.appendChild(deleteButton);
                }
        }));
    } catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
function createTagList(tags) {
    const tagList = document.createElement('article');
    tagList.classList.add('card-body', 'd-flex');

    tags.forEach(tagName => {
        const span = createTagSpan(tagName);
        tagList.appendChild(span);
    });

    return tagList;
}

function createTagSpan(tagName) {
    const span = document.createElement('span');
    span.classList.add('badge', 'rounded-pill', 'd-inline');
    span.style.display = 'inline';
    span.style.backgroundColor = "#E30380";
    span.innerText = tagName;
    return span;
}
function createDeleteButton() {
    const deleteButton = document.createElement('button');
    deleteButton.classList.add('btn', 'btn-danger', 'mt-2');  // Adding classes for Bootstrap button styles
    deleteButton.innerText = 'Delete';

    return deleteButton;
}
async function deleteThread(thread_id) {
    const res = await fetch(`http://localhost/api/thread/delete?thread_id=${thread_id}`, {
        method: 'DELETE',  // Change method to DELETE
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!res.ok) {
        throw new Error('Failed to delete the thread.');
    }

    return await res.json();  // Return the response, if needed
}
async function getThreads(board_id)
{
    const res = await fetch(`http://localhost/api/thread/threads?board_id=${board_id}` , 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve threads.');
    }
    return await res.json();
}
async function getUser(user_id)
{
    const res = await fetch(`http://localhost/api/user/username?user_id=${user_id}` , 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve user.');
    }
    return await res.json();
}
async function getTags(thread_id)
{
    
    const res = await fetch(`http://localhost/api/threadtag?thread_id=${thread_id}`, 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve threads.');
    }
    console.log(`http://localhost/api/threadtag?thread_id=${thread_id}`);
    const tags = await res.json();
    return tags;
}