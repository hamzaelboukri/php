function showPage(page) {
    const validationPage = document.querySelector('.validation');

    validationPage.style.display = 'block';
  

  
  }

  function toggleAddPlayerForm() {
    const form = document.querySelector('.add-player');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
  }