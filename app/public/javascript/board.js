async function loadThreads()
{
    const threads = getThreads();
    threads.forEach(thread => {
        const tags = getTags(thread.id);
        const a = document.createElement('a');
        a.setAttribute('href', `${window.location.href}/${thread.id}`);
        a.classList.add('clickable-card');
        a.id = 'thread';

        const section = document.createElement('section');
        section.classList.add('card');

        const article = document.createElement('article');
        article.classList.add('card-body');

        const h4 = document.createElement('h4');
        h4.classList.add('card-title');
        h4.innerText = thread.title;

        const p = document.createElement('p');
        p.classList.add('card-text');
        p.innerText = thread.first_post;

        const small = document.createElement('small');
        small.classList.add('card-subtitle', 'mb-2', 'text-muted');
        small.innerText = thread.post_count;

        article.appendChild(h4);
        article.appendChild(p);
        article.appendChild(small);
        section.appendChild(article);
        a.appendChild(section);

        tags.forEach(tag => 
            {
                const span = document.createElement('span');
                span.classList.add('badge', 'badge-secondary', 'mr-1');
                span.innerText = tag.tag_name;
                article.appendChild(span);
            });
    });
}
async function getThreads()
{
    const res = await fetch('/api/thread/threads' , 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve threads.');
    }

    const threads = await res.json();
    return threads;
}
async function getTags(thread_id)
{
    
    const res = await fetch(`/api/tag?thread_id=${thread_id}`, 
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    if (!res.ok) {
        throw new Error('Failed to retrieve threads.');
    }
    const tags = await res.json();
    return tags;
}