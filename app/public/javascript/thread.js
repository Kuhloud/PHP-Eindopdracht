function createThread(user_id) {
    alert('createThread() called');

    // Create an object with the data from the form (title and first_post)
    let formData = {
        title: document.getElementById('threadTitle').value,
        firstPost: document.getElementById('firstPost').value,
        tags: document.getElementById('tags').value
    };

    // Create new thread / Post the data to http://localhost/api/thread using fetch
    fetch('http://localhost/api/thread',
        {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(
                {
                    title: formData.title,
                    firstPost: formData.firstPost,
                    user_id: user_id
                }
            )
        })
        .then(response => { response.json() })
        .then(data => {
            console.log('Success:', data);
            addTags(data.thread_id, formData.tags);
            createFirstPost(data.thread_id, data.first_post, user_id);
        })
        .catch(error => {
            console.error('Error message:', error.message);
            console.error('Error object:', error);
        });
}
function addTags(thread_id, tags) 
{
            // Action 2: Turn first post into a post object
            fetch('http://localhost/api/tag', 
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    {
                        thread_id: thread_id,
                        tags: tags,
                    }
                )
            })        
            .then(response => { response.json() })
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error message:', error.message);
                console.error('Error object:', error);
            });
}
function createFirstPost(thread_id, first_post, user_id) 
{
    fetch('http://localhost/api/post', 
    {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(
            {
                thread_id: thread_id,
                message: first_post,
                user_id: user_id
            }
        )
    })
    .then(response => { response.json() })
    .then(data => {
        console.log('Success:', data);
    })
    .catch(error => {
        console.error('Error message:', error.message);
        console.error('Error object:', error);
    });
}