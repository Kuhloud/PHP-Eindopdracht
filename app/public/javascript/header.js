document.addEventListener('DOMContentLoaded', () => {
    const url = window.location.href;
    const board_id = url.split('/').pop();

    // Check if the current page is a board page
    if (url.includes('/board/')) {
        loadThreads(board_id);
    }
});