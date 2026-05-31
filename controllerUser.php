<?php

include "./utils.php";
include "./modelUser.php";
include "./viewAddUser.php";
include "./viewReadUser.php";

class ControllerUser
{
  private ?viewAddUser $viewAddUser;
  private ?viewAddUser $viewReadUser;
  private ?modelUser $modelUser;

  public function __construct(?viewAddUser $newViewAddUser, ?viewReadUser $setViewReadUser, ?modelUser $newModelUser)
  {
    $this->viewAddUser = $newViewAddUser;
    $this->modelUser = $newModelUser;
  }

  public function getViewAddUser(): ?viewAddUser
  {
    return $this->viewAddUser;
  }

  public function setViewAddUser(?viewAddUser $viewAddUser): self
  {
    $this->viewAddUser = $viewAddUser;
    return $this;
  }

  public function getViewReadUser(): ?viewReadUser
  {
    return $this->viewReadUser;
  }

  public function setViewReadUser(?viewReadUser $viewReadUser): self
  {
    $this->viewReadUser = $viewReadUser;
    return $this;
  }

  public function getModelUser(): ?modelUser
  {
    return $this->modelUser;
  }

  public function setModelUser(?modelUser $modelUser): self
  {
    $this->modelUser = $modelUser;
    return $this;
  }

  public function addUser(): string
  {
    $msg = '';

    if (isset($_POST['submit-user'])) {
      if (!empty($_POST['email']) && !empty($_POST['password'])) {


        //validation email + sanitize
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $email = sanitize($_POST['email']);
          $password = sanitize($_POST['password']);
          $password = password_hash($password, PASSWORD_BCRYPT);

          // adresse mail unique?
          try {
            $data = $this->getModelUser()->setEmail($email)->getUserByEmail();
            if (empty($data)) {
              $this->getModelUser()->setEmail($email)->setPassword($password);

              $msg = $this->getModelUser()->create();
            } else {
              $msg =  "Cet adresse mail existe déjà sur un autre compte.";
            }
          } catch (Exception $e) {
            $msg = 'Une erreur est survenue.';
          }
        } else {
          $msg = "Le mail n'est pas au bon format";
        }
      } else {
        $msg = "Veuillez remplir les champs obligatoires.";
      }
    }
    return $msg;
  }

  // public function readUsers(): string | array {}

  public function render(): void
  {
    $msg = $this->addUser();
    echo $this->getViewAddUser()->setMessage($msg)->displayView();
  }
}

$addUser = new ControllerUser(new viewAddUser(), new viewReadUser(),  new ModelUser());
$addUser->render();