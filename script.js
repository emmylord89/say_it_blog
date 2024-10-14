let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}
document.addEventListener("DOMContentLoaded", function() {
    const postContainer = document.getElementById('post-container');

    // Fetch recent posts from the backend
    fetch('get_recent_posts.php')
        .then(response => response.json())
        .then(posts => {
            posts.forEach(post => {
                // Create post element
                const postElement = document.createElement('div');
                postElement.classList.add('post');

                // Add title
                const titleElement = document.createElement('h2');
                titleElement.textContent = post.title;
                postElement.appendChild(titleElement);

                // Add content
                const contentElement = document.createElement('p');
                contentElement.textContent = post.content;
                postElement.appendChild(contentElement);

                // Add media (image/video)
                if (post.media) {
                    const mediaElement = document.createElement('img');
                    mediaElement.src = `uploads/${post.media}`;
                    mediaElement.style.width = "100%";  // Set width to 100%
                    postElement.appendChild(mediaElement);
                }

                // Add creation date
                const dateElement = document.createElement('small');
                dateElement.textContent = `Posted on: ${new Date(post.created_at).toLocaleString()}`;
                postElement.appendChild(dateElement);

                // Append the post element to the post container
                postContainer.appendChild(postElement);
            });
        })
        .catch(error => console.error('Error fetching posts:', error));
});
