<?php

include "./utils.php";

class ModelUser
{
  private int $id_user;
  private string $email;
  private string $password;
  private DateTime $created_at;
  private PDO $db;


  public function __construct()
  {
    $this->db = connect();
  }

  public function getId(): int
  {
    return $this->id_user;
  }

  public function setId(int $id_user): self
  {
    $this->id_user = $id_user;
    return $this;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;
    return $this;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;
    return $this;
  }

  public function getTime(): DateTime
  {
    return $this->created_at;
  }

  public function setTime(DateTime $created_at): self
  {
    $this->created_at = $created_at;
    return $this;
  }

  public function getDb(): PDO
  {
    return $this->db;
  }

  public function setDb(PDO $db): self
  {
    $this->db = $db;
    return $this;
  }

  //METHOD

  public function create(): string
  {
    try {
      $req = $this->getDb()->prepare("INSERT INTO `users` (email, `password`) VALUES (?, ?)");

      $email = $this->getEmail();
      $password = $this->getPassword();

      $req->bindParam(1, $email, PDO::PARAM_STR);
      $req->bindParam(2, $password, PDO::PARAM_STR);
      $req->execute();

      return "L'enregistrement de $email, a été effectué avec succès.";
    } catch (Exception $e) {
      return "Erreur lors de l'inscription.";
    }
  }

  public function readUser(): array | string
  {
    try {
      $req = $this->getDb()->prepare("SELECT id_user, email, created_at FROM `users` WHERE id_user = ? LIMIT 1;");
      $id = $this->getId();
      $req->bindParam(1, $id, PDO::PARAM_INT);
      $req->execute();
      $data = $req->fetchAll(PDO::FETCH_ASSOC);

      if (!$data) {
        return "Aucun utilisateur trouvé";
      }

      return $data;
    } catch (Exception $e) {
      return "Une erreur est survenue.";
    }
  }

  public function getUserByEmail(): array | string
  {
    try {
      $req = $this->getDb()->prepare("SELECT id_user, email, created_at FROM `users` WHERE email = ? LIMIT 1;");
      $email = $this->getEmail();
      $req->bindParam(1, $email, PDO::PARAM_INT);
      $req->execute();
      $data = $req->fetchAll(PDO::FETCH_ASSOC);

      if (!$data) {
        return "Aucun utilisateur trouvé";
      }
      return $data;
    } catch (Exception $e) {
      return "Une erreur est survenue.";
    }
  }

  public function readAllUsers(): array | string
  {
    try {
      $req = $this->getDb()->prepare("SELECT id_user, email, created_at FROM `users`");
      $req->execute();
      $data = $req->fetchAll(PDO::FETCH_ASSOC);

      if (!$data) {
        return "Aucun utilisateur trouvé";
      }

      return $data;
    } catch (Exception $e) {
      return $e->getMessage();
      //todo => getMessage() é bom para dev, já que te dá pistar do BDD. Para produção JAMAIS! melhor algo como a função readUser
    }
  }



  // Update
  // UPDATE `users`
  // SET email = 'pedro@email.com', `password` = '123456';
  // WHERE condição

  public function delete(): string
  {
    try {
      $req = $this->getDb()->prepare("DELETE `admin` WHERE id_admin = ?");
      $id = $this->getId();
      $req->bindParam(1, $id, PDO::PARAM_INT);
      $req->execute();

      return "L'admin d'id $id a été éffacé.";
    } catch (EXCEPTION $e) {
      return "Une erreur est survenue.";
    }
  }
}
