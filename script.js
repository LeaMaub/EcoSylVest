document.querySelector('.btn.btn-primary.btn-lg').addEventListener('click', function(e) {
  e.preventDefault();
  
  // Sélectionne toutes les discussions avec la classe "additional" et ajoute la classe "hidden-discussion"
  var additionalDiscussions = document.querySelectorAll('.additional');
  additionalDiscussions.forEach(function(discussion) {
      discussion.classList.remove('hidden-discussion'); // Retire la classe pour afficher les discussions
  });

  // Cache le bouton, car toutes les discussions sont maintenant affichées
  this.style.display = 'none';
});


