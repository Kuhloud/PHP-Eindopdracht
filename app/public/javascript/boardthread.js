document.addEventListener('DOMContentLoaded', () => {
    const url = window.location.href;
    const segments = url.split('/');
    const thread_id = segments[segments.length - 1];
    loadPosts(thread_id);
});
async function getPosts(thread_id)
{
    const res = await fetch(`http://localhost/api/post/thread?thread_id=${thread_id}` , 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve posts.');
    }
    return await res.json();
}
async function createPost(thread_id, user_id)
{
    const message = document.getElementById('post').value;
    if (message === '') {
        displayError('Title and first post are required');
        return;
    }
    try
    {
        await createNewPost(thread_id, message, user_id)
        await updatePostCount(thread_id, 1)
        window.location.reload();
    }
    catch (error) {
        console.error('Error:', error.message, 'Stack:', error.stack);
    }
}
async function createNewPost(thread_id, message, user_id)
{
    try
    {
        const response = await fetch('http://localhost/api/post', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                thread_id: thread_id,
                message: message,
                user_id: user_id
            })
        })
        if (!response.ok) {
            const error = await response.text();
            console.log(error);
            throw new Error('Failed to create post');
        }
        console.log('New post created');
        return await response.json();

    }
    catch (error) {
        console.error('An error occurred:');
    }
}
async function updatePostCount(thread_id, postCountChange)
{
    const response = await fetch(`http://localhost/api/thread/updateCount?thread_id=${thread_id}`,
        {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json'
        },
        body: JSON.stringify({
            post_count: postCountChange
        })
    })
    if (!response.ok) {
        const error = await response.text();
        console.log(error);
        throw new Error('Failed to update post count');
    }
    console.log('Post count updated successfully');
}
async function loadPosts(thread_id) {
    try {
        const posts = await getPosts(thread_id);
        posts.sort((a, b) => Date.parse(a.posted_at) - Date.parse(b.posted_at));
        await Promise.all(posts.map(async post => {
                const username = await getUser(post.user_id);
    
                const section = document.createElement('section');
                section.classList.add('card');
    
                const article = document.createElement('article');
                article.classList.add('card-body', 'd-flex', 'flex-column');
    
                const message = document.createElement('p');
                message.classList.add('card-text');
                message.innerText = post.message;

                const dateOfCreation = document.createElement('small');
                dateOfCreation.classList.add('card-subtitle', 'mb-2', 'text-muted');
                dateOfCreation.innerText = `Created at: ${post.posted_at}` ;
    
                const user = document.createElement('small');
                user.classList.add('card-subtitle', 'mb-2', 'text-muted');
                user.innerText = username;

                article.appendChild(message);
                article.appendChild(dateOfCreation);
                article.appendChild(user);

                section.appendChild(article);
                const element = document.getElementById('posts').appendChild(section);
                if (userRole === 3 || userRole === 2)
                {
                    const deleteButton = createDeleteButton();
                    deleteButton.addEventListener('click', async function() {
                        await deletePost(post.post_id);
                        await updatePostCount(thread_id, -1)
                        const postElement = this.parentNode;
                        postElement.remove();
                    });
                    element.appendChild(deleteButton);
                }
        }));
    } catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
}
function createDeleteButton() {
    const deleteButton = document.createElement('button');
    deleteButton.classList.add('btn', 'btn-danger', 'mt-2');
    deleteButton.innerText = 'Delete';

    return deleteButton;
}
async function deletePost(post_id) {
    const res = await fetch(`http://localhost/api/post/delete?post_id=${post_id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!res.ok) {
        throw new Error('Failed to delete the thread.');
    }

    return await res.json();  // Return the response, if needed
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
}