<?php

include "./utils.php";
include "./modelUser.php";
include "./viewAddUser.php";
include "./viewReadUser.php";

class ControllerUser
{
  private ?ViewAddUser $viewAddUser;
  private ?ViewReadUser $viewReadUser;
  private ?ModelUser $modelUser;

  public function __construct(?ViewAddUser $newViewAddUser, ?ViewReadUser $setViewReadUser, ?ModelUser $newModelUser)
  {
    $this->viewAddUser = $newViewAddUser;
    $this->viewReadUser = $setViewReadUser;
    $this->modelUser = $newModelUser;
  }

  public function getViewAddUser(): ?ViewAddUser
  {
    return $this->viewAddUser;
  }

  public function setViewAddUser(?ViewAddUser $viewAddUser): self
  {
    $this->viewAddUser = $viewAddUser;
    return $this;
  }

  public function getViewReadUser(): ?ViewReadUser
  {
    return $this->viewReadUser;
  }

  public function setViewReadUser(?ViewReadUser $viewReadUser): self
  {
    $this->viewReadUser = $viewReadUser;
    return $this;
  }

  public function getModelUser(): ?ModelUser
  {
    return $this->modelUser;
  }

  public function setModelUser(?ModelUser $modelUser): self
  {
    $this->modelUser = $modelUser;
    return $this;
  }


  //todo METHODS

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

  public function readUsers(): string | array {}


  //todo RENDERS

  public function renderAdd(): void
  {
    $msg = $this->addUser();
    echo $this->getViewAddUser()->setMessage($msg)->displayView();
  }

  public function renderRead(): void
  {
    $msg = $this->readUsers();
    echo $this->getViewReadUser()->setMessage($msg)->displayView();
  }
}