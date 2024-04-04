document.addEventListener('DOMContentLoaded', () => {
    fetch('/courses')
      .then(response => response.json())
      .then(courses => {
        const app = document.getElementById('app');
        courses.forEach(course => {
          const courseElement = document.createElement('div');
          courseElement.innerHTML = `
            <div class="course">
              <img src="${course.image}" alt="${course.title}">
              <h2>${course.title}</h2>
              <p>${course.description}</p>
              <a href="#">Ver mais</a>
            </div>
          `;
          app.appendChild(courseElement);
        });
      })
      .catch(error => console.error('Error fetching courses:', error));
  });
  