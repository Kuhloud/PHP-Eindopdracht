// board
function ProcessThread(boardId) {
    $_SESSION['board_url'] = boardId;
    window.location.href = "/thread";
}
function PassToPhp() {
    $(document).ready(function () {
        $('#createThreadBtn').click(function () {
          var boardId = $(this).data('board-id');
    
          // AJAX request to the server
          $.ajax({
            url: '/thread',
            method: 'POST',  // Adjust the method based on your server-side handling
            data: { boardId: boardId },
            success: function (response) {
              // Handle the response if needed
              console.log(response);
            },
            error: function (error) {
              console.error('Error:', error);
            }
          });
        });
      });
}