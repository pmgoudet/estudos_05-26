<?php

class viewAddUser
{

  // private ?string $message = '';

  // public function getMessage(): ?string
  // {
  //   return $this->message;
  // }

  // public function setMessage(?string $newMessage): self
  // {
  //   $this->message = $newMessage;
  //   return $this;
  // }

  //METHOD
  public function displayView(): string
  {
    return <<<HTML
    <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet Mai/26</title>
      </head>

      <body>
        <header>
          <h1>ENREGISTREMENT D'UTILISATEURS</h1>
        </header>
        <main>
        <form action="" method="post" style="margin-bottom: 40px;">
          <label for="email">Ton email:</label> <br>
          <input type="text" id="email" name="email"><br>
          <label for="password">Ton mdp:</label><br>
          <input type="password" id="password" name="password"><br><br>
          <button type="submit" name="submit-user">Enregistrer</button>
        </form>

        <a href="">Liste d'utilisateurs</a>
        </main>
      </body>

      </html>
    HTML;
  }
}
