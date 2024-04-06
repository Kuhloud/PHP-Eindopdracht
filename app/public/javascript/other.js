function redirectToSlugUrl(boardName) {
    let slug = hideIdInURL(boardName);
    let currentUrl = new URL(window.location.href);
    currentUrl.pathname = currentUrl.pathname.replace(/[^/]*$/, slug);
    window.location.href = currentUrl.href;
}
function Sluggify(boardName) {
    return text
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    
}
function hideIdInURL(boardname) {
    return text
        .toLowerCase()
        .replace(/\d+/g, '') // remove numbers
        .replace(/[^a-z]+/g, '-') // replace non-letter characters with hyphen
        .replace(/^-+|-+$/g, ''); // remove leading and trailing hyphens
}