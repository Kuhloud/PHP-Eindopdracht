document.addEventListener('DOMContentLoaded', () => {
    const url = window.location.href;
    const segments = url.split('/');
    const thread_id = segments[segments.length - 1];
    getPosts(thread_id);
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
    const threads = await res.json();
    return threads;
}
async function createPost(thread_id, message, user_id) 
{
    try
    {
        const response = await fetch('http://localhost/api/post', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                message: message,
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
async function loadPosts(board_id) {
    try {
        const threads = await getThreads(board_id);
        threads.sort((a, b) => Date.parse(a.created_at) - Date.parse(b.created_at));
        await Promise.all(threads.map(async thread => {
                const tags = await getTags(thread.thread_id);
                const username = await getUser(thread.user_id);
                const a = document.createElement('a');
                a.setAttribute('href', `${window.location.href}/${thread.thread_id}`);
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


                section.appendChild(article);
                a.appendChild(section);
    
                document.getElementById('threads').appendChild(a);
        }));
    } catch (error) {
        console.error('An error occurred:', error.message, 'Stack:', error.stack);
    }
}