var modalAddProfile = document.getElementById('addAdminProfile');
var addUser = 'Ajouter un nouvel utilisateur';
var addBtn='addUserBtn';
var modalEditProfile=document.getElementById('editProfile');
var editUser = "Modifier un profil";
var editBtn='editUserBtn';
var actionForm = 'code.php';



addModalProfile(modalAddProfile, actionForm, addUser,addBtn);
// addModalProfile(modalEditProfile,actionForm,editUser,editBtn);

//make a modal To add or edit profile
function addModalProfile(modal, actionForm, toDo,btn,id='',username='',email='',password='',type='user') {
    $modal = modal;
    while ($modal.firstChild) {
  $modal.removeChild($modal.firstChild);
}
    $modal.classList.add("modal", "fade");
    $modal.setAttribute("tabindex", "-1");
    $modal.setAttribute("role", "dialog");
    $modal.setAttribute("aria-hidden", "true");

    var $modalDialog = document.createElement('div');
    $modalDialog.className = 'modal-dialog';
    $modalDialog.setAttribute("role", "document");

    var $modalContent = document.createElement('div');
    $modalContent.className = "modal-content";

    var $form = document.createElement('form');
    // var $actionForm = actionForm;
    $form.setAttribute('action', actionForm);
    $form.setAttribute('method', 'POST');

    var $modalBody = document.createElement('div');
    $modalBody.className = 'modal-body';
    $modalBody.innerHTML = '<div class="form-group"><input type="hidden" name="id" value="'+id+'"><label >Nom</label><input type="text" name="username" class="form-control"  placeholder="Enter Username" value="'+username+'"></div><div class="form-group"><label >Email</label><input type="email" name= "email" class="form-control" placeholder="Enter email" value="'+email+'"></div><div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" placeholder="Password" value="'+password+'"></div><div class="form-group"><label>Confirmez le password</label><input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password"></div>';

    var $profilType=document.createElement('div');
    $profilType.innerHTML='<label>Droit</label><select class="form-control" name="profilType" ><option value="user">Utilisateur</option><option value="admin">Administrateur</option></select>'
   
    var $modalFooter = document.createElement('div');
    $modalFooter.className = 'modal-footer';

    var $button = document.createElement('button');
    // var $btn=btn;
    $button.setAttribute("name", btn);
    $button.setAttribute("type", "submit");
    $button.innerText = "Enregistrer";


    var $modalHeader = document.createElement('div');
    $modalHeader.className = "modal-header";
    var $toDo = toDo;
    $modalHeader.innerHTML = '<h5 class="modal-title" >' + $toDo + '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

    $modalBody.appendChild($profilType);
    $form.appendChild($modalBody);
    $modalFooter.appendChild($button);
    $form.appendChild($modalFooter);
    $modalContent.appendChild($modalHeader);
    $modalContent.appendChild($form);
    $modalDialog.appendChild($modalContent);
    $modal.appendChild($modalDialog);
}
