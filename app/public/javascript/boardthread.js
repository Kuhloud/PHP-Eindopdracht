document.addEventListener('DOMContentLoaded', () => {
    const url = window.location.href;
    const segments = url.split('/');
    const thread_id = segments[segments.length - 1];
    loadPosts(thread_id);
});
async function getPosts(thread_id) {
    const res = await fetch(`http://localhost/api/post/thread?thread_id=${thread_id}`,
        {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
    if (!res.ok) {
        throw new Error('Failed to retrieve posts.');
    }
    const posts = await res.json();
    console.log('Post loaded:', posts);
    return posts;
}
async function createPost(thread_id, user_id) {
    const postData = document.getElementById('postMessage').value;
    createNewPost(thread_id, postData, user_id)
        .then(() => {
            loadPosts(thread_id);
        })

}
async function createNewPost(thread_id, post, user_id) {
    try {
        const response = await fetch('http://localhost/api/post', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                thread_id: thread_id,
                post: post,
                user_id: user_id
            })
        });
        const data = await response.json();
        console.log('Post created:', data);

        await fetch(`http://localhost/api/thread?thread_id=${thread_id}`, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json'
            }
        });

        console.log('Post count updated');
    } catch (error) {
        console.error('Error:', error.message, 'Stack:', error.stack);
    }
}
async function loadPosts(thread_id) {
    try {
        const posts = await getPosts(thread_id);
        posts.sort((a, b) => Date.parse(a.posted_at) - Date.parse(b.post_at));
        await Promise.all(posts.map(async post => {
            const username = await getUser(post.user_id);

            const article = document.createElement('article');
            article.classList.add('card-body', 'd-flex', 'flex-column');

            const user = document.createElement('h2');
            user.classList.add('card-title');
            user.innerText = username;

            const postMessage = document.createElement('p');
            postMessage.classList.add('card-text');
            postMessage.innerText = post.message;

            const dateOfCreation = document.createElement('small');
            dateOfCreation.classList.add('card-subtitle', 'mb-2', 'text-muted');
            dateOfCreation.innerText = `Posted at: ${post.posted_at}`;

            article.appendChild(user);
            article.appendChild(postMessage);
            article.appendChild(dateOfCreation);

            document.getElementById('posts').appendChild(article);
        }));
    } catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}
async function getUser(user_id) {
    const res = await fetch(`http://localhost/api/user/username?user_id=${user_id}`,
        {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
    if (!res.ok) {
        throw new Error('Failed to retrieve user.');
    }
    const username = await res.json();
    return username;
}