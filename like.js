document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-button').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // empêche le lien de se comporter comme un lien normal
            let replyId = this.getAttribute('data-reply-id');
            let discussionId = this.getAttribute('data-discussion-id');
            
            // Appel AJAX
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'post/like_reply.php?reply_id=' + replyId + '&id=' + discussionId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettre à jour l'interface utilisateur ici, par exemple:
                    document.getElementById('like-count-' + replyId).innerText = xhr.responseText;
                }
            }
            xhr.send();
        });
    });
});
