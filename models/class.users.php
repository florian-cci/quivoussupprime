<?php
require_once '../vendor/autoload.php';


use Facebook\Facebook;

$fb = new Facebook([
  'app_id' => '189561574570455',
  'app_secret' => 'ceca847222e185f56fa586b0b95eb261',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

// Remplacez 'your-callback-url' par l'URL où Facebook redirigera après l'authentification de l'utilisateur
$permissions = ['email', 'user_friends'];
$loginUrl = $helper->getLoginUrl('index.php', $permissions);

// Récupération de l'access token de l'utilisateur
try {
    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
        $fb->setDefaultAccessToken($accessToken);

        // Récupération de la liste des amis de l'utilisateur
        $response = $fb->get('/me/friends?fields=name,id');
        $friends = $response->getGraphEdge()->asArray();

        // Stockage de la liste des amis actuels de l'utilisateur
        $currentFriends = [];
        foreach ($friends as $friend) {
            $currentFriends[$friend['id']] = $friend['name'];
        }

        // Récupération de l'historique des amis de l'utilisateur
        $response = $fb->get('/me/friendrequests');
        $friendRequests = $response->getGraphEdge()->asArray();

        // Détection des amis qui ont supprimé l'utilisateur
        $deletedFriends = [];
        foreach ($friendRequests as $request) {
            if (!array_key_exists($request['to']['id'], $currentFriends)) {
                $deletedFriends[$request['to']['id']] = $request['to']['name'];
            }
        }

        // Affichage des amis qui ont supprimé l'utilisateur
        if (!empty($deletedFriends)) {
            echo "Les amis suivants vous ont supprimé de leur liste d'amis :\n";
            foreach ($deletedFriends as $id => $name) {
                echo "$name (ID: $id)\n";
            }
        } else {
            echo "Personne ne vous a supprimé de sa liste d'amis.\n";
        }
    } else {
        echo '<a href="' . htmlspecialchars($loginUrl) . '">Se connecter avec Facebook</a>';
    }
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
?>