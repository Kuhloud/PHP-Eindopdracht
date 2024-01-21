// board
function ProcessThread(boardId) {
    $_SESSION['board_url'] = boardId;
    window.location.href = "/board/" + boardId;
}