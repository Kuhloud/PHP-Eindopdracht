async function loadData() {

    // use fetch to retrieve the articles from http://localhost/api/user

    const response = await fetch("http://localhost/api/user");
    const user = await response.json();
    console.log(user);

    // Create an H2 with the title and a p with the content for every article
    // And display the articles on the page by appending them to the 'articles' div
    const div = document.getElementById('articles');
    div.innerHTML = '';

    articles.forEach(article => {
        const h2 = document.createElement('h2');
        h2.innerText = article.title;
        const p = document.createElement('p');
        p.innerText = article.content;
        div.appendChild(h2);
        div.appendChild(p);
    });

}

async function sendForm() {

    // Create an object with the data from the form (title and content)
    let data = {
        title: document.getElementById('title').value,
        content: document.getElementById('content').value
    };

    // Post the data to http://localhost/api/article using fetch
    const response = await fetch('http://localhost/api/article',
        {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        });

    if (!response.ok) {
        
        // Note: We shouldn't actually send detailed backend errors to our clients 
        // in a production environment. Log them in the backend instead.

        const error = await response.text();
        console.log(error);

        const form = document.getElementById('myForm');
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('alert', 'alert-danger');

        errorDiv.innerHTML = error;
        form.prepend(errorDiv);
    }

    // (Optional) Reload the articles on the page afterward
    loadData();
}