<?php declare(strict_types=1);

Class Publication {
	protected int $idPublication;
	protected int $idImage;
	protected int $idUser;
	protected string $dateDePublication;
	protected string $message;

	public function __construct(array $data) {
		$this->idPublication		= intval($data['idPublication']) ?? 0;
		$this->idImage				= intval($data['idImage']) ?? 0;
		$this->idUser				= intval($data['idUser']) ?? 0;
		$this->dateDePublication	= $data['dateDePublication'] ?? "";
		$this->message				= $data['message'] ?? "";
	}

	public function generateHtmlPost() : string {
		$user = User::createFromId($this->idUser);
		$idAvatar = $user->getIdImage();
		$firstName = $user->getFirstName();
		$lastName = $user->getLastName();
		$image = "";
		if ($this->idImage != 0)
			$image = <<<HTML
			<img class="card-img-bottom" src="getImage.php?id={$this->idImage}" alt="Card image cap">
HTML;
		return <<<HTML
	<div class="post-user">
		<div class="card">
			<div class="card-header">
				<img src="getImage.php?id=$idAvatar" class="card-avatar" placeholder="Avatar">
				<span class="username-post">$firstName $lastName</span>
				<div class="post-info">Lieu : <span class="post-location">Reims</span> | Date : <span class="post-date">30/11/21</span> à 11h00</div>
			</div>
			<p class="post-message">{$this->message}</p>
$image
		</div>
		<div class="comments"></div>
		<input class="comment-input" id="input" name="comment" placeholder="Ajouter un commentaire...">
		<div class="post-comment" id="btnn">Publier<svg class="svg-icon" id="icon-btn" viewBox="0 0 20 20">
				<path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
			</svg>
		</div>
	</div>

HTML;
	}

	/** Accesseurs **/
	public function getIdPublication() : int { return $this->idPublication; }
	public function getIdImage() : int { return $this->idImage; }
	public function getIdUser() : int { return $this->idUser; }
	public function getDateDePublication() : string { return $this->dateDePublication; }
	public function getMessage() : string { return $this->message; }
}
