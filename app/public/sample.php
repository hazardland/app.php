<?php

	include __DIR__.'/config.php';

	use \App\Cache;
	use \App\Route;
	use \App\Input;
	use \App\View;

    use Html\Document;
    use Html\Select;

    error_reporting(E_ALL & ~E_NOTICE);

    if (function_exists('apcu_store'))
    {
        Cache::init (new \App\Cache\Driver\APCu());
    }
    else if (function_exists('apc_store'))
    {
        Cache::init (new \App\Cache\Driver\APC());
    }


    fortunejack::setDatabase ($database);
    reports::setDatabase ($database);
    admin::setDatabase ($database);

	Route::get('player/{id}', '\admin\admin.setPlayerByID')->where('id',Input::INT);
	Route::get('player/{login}', '\admin\admin.setPlayerByLogin');
	Route::get('player', function(){
		admin::setPlayer ($_REQUEST['player_id'], $_REQUEST['player_login']);
	});
	Route::post('wallet', function(){
		fortunejack::savePlayerWallet (admin::getPlayerID(), $_REQUEST['player_wallet_save']);
	});
	Route::post('comppoints', function(){
		fortunejack::savePlayerComppoints (admin::getPlayerID(), $_REQUEST['player_comppoints_save']);
	});
	Route::put('bonus', function(){
		fortunejack::addPlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_add']);
	});
	Route::post('bonus', function(){
		fortunejack::savePlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_save']);
	});
	Route::delete('bonus', function(){
		fortunejack::deletePlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_delete']);
	});
	Route::post('content', function(){
		return view('index',['content'=>true]);
	});
    Route::get('game', function(){
        admin::setPlayerGame ($_REQUEST['player_game_set']);
    });
    Route::get('cache/clean', function(){
        Cache::clean();
        Document::redirect();
    });
    Route::get('session/close', function(){
        session_destroy();
        Document::redirect();
    });
    Route::get('player/bet', function(){
        admin::playerBet ($_REQUEST['player_bet']);
    });
    Route::get('player/win', function(){
        admin::playerWin ($_REQUEST['player_win']);
    });
    Route::get('player/win/free', function(){
        admin::playerWinFree ($_REQUEST['player_win_free']);
    });
    Route::get('player/cancel/round', function(){
        admin::playerCancelRound ($_REQUEST['player_cancel_round']);
    });
    Route::get('player/cancel', function(){
        admin::playerCancel ($_REQUEST['player_cancel']);
    });
    Route::get('reports/import', function(){
        admin::reportsImportProcess ($_REQUEST['reports_import_process']);
    });
    Route::get('bonus/ticket/generate', function(){
        admin::bonusTicketGenerate ($_REQUEST['bonus_ticket_generate']);
    });
    Route::get('bonus/ticket/check', function(){
        admin::bonusTicketActivateCheck ($_REQUEST['bonus_ticket_activate_check']);
    });
    Route::get('bonus/ticket/activate', function(){
        admin::bonusTicketActivate ($_REQUEST['bonus_ticket_activate']);
    });
    Route::get('/transfer/deposit/after', function(){
        admin::transferDepositAfter ($_REQUEST['transfer_deposit_after']);
    });
    Route::get('/api/getGamesByProviderID/{provider_id}', function($provider_id){
        echo Select::options([0=>'']+fortunejack::getGamesByProviderID($_REQUEST['provider_id']));
        ob_end_flush();
        exit;
    });
	Route::post('/', function(){
		return view('index',['content'=>false]);
	});
	debug (Route::$routes);

	if ($_REQUEST['player_id'] OR $_REQUEST['player_login'])
	{
		admin::setPlayer ($_REQUEST['player_id'], $_REQUEST['player_login']);
        exit;
	}
	if ($_REQUEST['player_wallet_save'])
	{
		fortunejack::savePlayerWallet (admin::getPlayerID(), $_REQUEST['player_wallet_save']);
        exit;
	}
	if ($_REQUEST['player_comppoints_save'])
	{
		fortunejack::savePlayerComppoints (admin::getPlayerID(), $_REQUEST['player_comppoints_save']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_bonus_add'])
	{
		fortunejack::addPlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_add']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_bonus_save'])
	{
		fortunejack::savePlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_save']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_bonus_delete'])
	{
		fortunejack::deletePlayerBonus (admin::getPlayerID(), $_REQUEST['player_bonus_delete']);
		Document::redirect();
        //exit;
	}
	if ($_REQUEST['player_game_set'])
	{
		admin::setPlayerGame ($_REQUEST['player_game_set']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['settings_cache_clean'])
	{
		Cache::clean();
		Document::redirect();
	}
	if ($_REQUEST['settings_session_close'])
	{
		session_destroy();
		Document::redirect();
	}
	if ($_REQUEST['player_bet'])
	{
		admin::playerBet ($_REQUEST['player_bet']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_win'])
	{
		admin::playerWin ($_REQUEST['player_win']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_win_free'])
	{
		admin::playerWinFree ($_REQUEST['player_win_free']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_cancel_round'])
	{
		admin::playerCancelRound ($_REQUEST['player_cancel_round']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['player_cancel'])
	{
		admin::playerCancel ($_REQUEST['player_cancel']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['reports_import_process'])
	{
		admin::reportsImportProcess ($_REQUEST['reports_import_process']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['bonus_ticket_generate'])
	{
		admin::bonusTicketGenerate ($_REQUEST['bonus_ticket_generate']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['bonus_ticket_activate_check'])
	{
		admin::bonusTicketActivateCheck ($_REQUEST['bonus_ticket_activate_check']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['bonus_ticket_activate'])
	{
		admin::bonusTicketActivate ($_REQUEST['bonus_ticket_activate']);
		//Document::redirect();
        exit;
	}
	if ($_REQUEST['transfer_deposit_after'])
	{
		admin::transferDepositAfter ($_REQUEST['transfer_deposit_after']);
		//Document::redirect();
        exit;
	}
	/*
		AJAX API CALLS
	*/
	if ($_REQUEST['action']=='getGamesByProviderID')
	{
		echo Select::options([0=>'']+fortunejack::getGamesByProviderID($_REQUEST['provider_id']));
		ob_end_flush();
		exit;
	}

?>
<?php if (!$_REQUEST['content']):?>
<html>
<head>
	<?=Document::script('public/jquery/jquery.js')?>
	<?=Document::script('public/jquery/restoreposition.js')?>
	<?=Document::script('public/jquery/ajaxsubmit.js')?>
	<?=Document::style('public/project/default.css')?>
	<?=Document::style('public/windows/windows.css')?>
	<?=Document::script('public/windows/windows.js')?>
	<title><?=admin::getPlayerID()?admin::getPlayerLogin():'Debug'?></title>
</head>
<body>
<div id="content">
<?php endif?>
	<?=admin::renderPlayer([15,160])?>
	<?=admin::renderPlayerWallets([15,14])?>
	<?=admin::renderPlayerBonuses([15,1120])?>
	<?php if (admin::getPlayerID()):?>
		<?=admin::renderSettings([105,162])?>
		<?=admin::renderPlayerBonusTickets([15,1856])?>
		<?=admin::renderPlayerBonusAdd([289,15])?>
		<?=admin::renderPlayerGame([15,301])?>
		<?php if (admin::getPlayerProviderID()):?>
			<?=admin::renderPlayerBet([15,468])?>
			<?=admin::renderPlayerWin([15,630])?>
			<?=admin::renderPlayerWinFree([15,818])?>
			<?=admin::renderPlayerCancelRound([15,970])?>
			<!--=admin::renderPlayerCancel([100,1000])-->
		<?php endif?>
		<?=admin::renderPlayerCancelLog([441,2402])?>
		<?=admin::renderPlayerTransferHour([187,188])?>
		<?=admin::renderReportsImportProcess([107,970])?>
		<?=admin::renderPlayerSessions([296,983])?>
		<?=admin::renderPlayerBonusTransfers([441,13])?>
		<?=admin::renderPlayerTransfers([441,1296])?>
		<?=admin::renderPlayerBonusTicketGenerate([214,1232])?>
		<?=admin::renderPlayerBonusTicketActivateCheck([214,1403])?>
		<?=admin::renderPlayerBonusTicketActivate([214,1548])?>
		<?=admin::renderTransferDepositAfter([214,1684])?>
		<?=admin::renderPlayerComppoints([414,1684])?>
	<?php endif?>
<?php if (!$_REQUEST['content']):?>
</div>
<script>
	function onFormSubmitSuccess()
	{
		$('#content').load ('index.php?content=true',renderDisplay);
	}

	function renderDisplay()
	{
		windows('.window',false);
		$('form').ajaxSubmit (onFormSubmitSuccess);
	}

	$(function()
	{
		renderDisplay();
	});
</script>
</body>

</html>
<?php endif?>
