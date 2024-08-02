// public/js/like.js
document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.getElementById('like-button');
    const likeCount = document.getElementById('like-count');

    if (likeButton) {
        likeButton.addEventListener('click', function() {
            const apunteId = likeButton.getAttribute('data-apunte-id');
            
            fetch('/conecter/apt/toggleLike', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'apunte_id': apunteId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    likeCount.textContent = data.likes;
                    likeButton.textContent = data.liked ? 'Quitar Like' : 'Dar Like';
                } else {
                    console.error('Error al procesar el like');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
