<?php


class viewReadUser
{

  private ?string $message = '';

  public function getMessage(): ?string
  {
    return $this->message;
  }

  public function setMessage(?string $newMessage): self
  {
    $this->message = $newMessage;
    return $this;
  }

  //METHOD
  public function displayView(): string
  {
    $msg = $this->getMessage();

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
          <h1>LISTE D'UTILISATEURS</h1>
        </header>
        <main>

        <p> $msg </p>

        <a href="">Retourner</a>
        </main>
      </body>

      </html>
    HTML;
  }
}
