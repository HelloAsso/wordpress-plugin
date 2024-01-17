<div class="ha-page-content">
	<style type="text/css">
		#wpbody-content {
			padding-bottom: 0;
		}

		#wpfooter {
			display: none;
		}

		.ha-campaign-right::-webkit-scrollbar {
			width: 5px;
		}

		.ha-campaign-right::-webkit-scrollbar-track {
			background: #E9E9F0;
			border-radius: 0;
			-webkit-box-shadow: 0;
			box-shadow: 0;
		}

		.ha-campaign-right::-webkit-scrollbar-thumb {
			background: #9A9DA8;
			border-radius: 0;
		}
	</style>
	<?php

	if (!isset($_GET['from'])) {
	?>
		<style type="text/css">
			#wpcontent {
				padding-left: 0;
			}
		</style>
	<?php
	}
	$months = array(
		'',
		'Janvier',
		'Février',
		'Mars',
		'Avril',
		'Mai',
		'Juin',
		'Juillet ',
		'Août',
		'Septembre',
		'Octobre',
		'Novembre',
		'Décembre',
	);

	$campaigns = get_option('ha-campaign');
	$donation = 0;
	$membership = 0;
	$paymentform = 0;
	$crowdfunding = 0;
	$event = 0;
	$shop = 0;

	$donationTitle = "Don";
	$membershipTitle = "Adhésion";
	$paymentformTitle = "Vente";
	$crowdfundingTitle = "Crowdfunding";
	$eventTitle = "Billetterie";
	$shopTitle = "Boutique";
	$arraySort = array();
	$nbCampaign = 0;
	foreach ($campaigns as $key => $campaign) :

		if (isset($campaign['endDate']) && strlen($campaign['endDate']) > 4) {
			if (time() > strtotime($campaign['endDate'])) {
				$incrementArray = 0;
			} else {
				$incrementArray = 1;
			}
		} else {
			$incrementArray = 1;
		}

		if (strtolower($campaign['formType']) == "event") {
			if (isset($campaign['startDate']) && time() > strtotime($campaign['startDate'])) {
				$incrementArray = 0;
			} else {
				$incrementArray = 1;
			}
		}


		if ($incrementArray == 1) {
			if (strtolower($campaign['formType']) == "membership") {
				$membership++;
			}
			if (strtolower($campaign['formType']) == "donation") {
				$donation++;
			}
			if (strtolower($campaign['formType']) == "paymentform") {
				$paymentform++;
			}
			if (strtolower($campaign['formType']) == "crowdfunding") {
				$crowdfunding++;
			}
			if (strtolower($campaign['formType']) == "event") {
				$event++;
			}
			if (strtolower($campaign['formType']) == "shop") {
				$shop++;
			}

			$arraySort[$campaign['formType']][] = $campaign;
			$nbCampaign++;
		}

	endforeach;
	?>

	<div class="ha-container ha-container-campaign">
		<div class="ha-campaign-left">
			<div class="ha-header">
				<div class="ha-header-row">
					<div class="ha-header-col">
						<?php
						if (get_option('ha-error') == 0) :
							if (get_option('ha-sync') > strtotime('-90 days')) : ?>
								<h1><?= stripslashes(get_option('ha-name')); ?></h1>
								<h5>Dernière synchronisation réussie le <?= date('d/m/Y à H:i:s', get_option('ha-sync')); ?></h5>
							<?php else : ?>
								<h1><?= stripslashes(get_option('ha-name')); ?></h1>
								<div class="ha-header-message-flex">
									<img src="<?= plugin_dir_url(__FILE__); ?>icons/alert-triangle.svg" />
									<h5>Dernière synchronisation réussie le <?= date('d/m/Y à H:i:s', get_option('ha-sync')); ?>. <span class="semibold">Veuillez resynchroniser.</span></h5>
								</div>
							<?php
							endif;
						else :
							$nbCampaign = 0;
							?>
							<h1><?= stripslashes(get_option('ha-name')); ?></h1>
							<div class="ha-header-message-flex">
								<img src="<?= plugin_dir_url(__FILE__); ?>icons/alert-triangle.svg" />
								<h5>La synchronisation a échouée</h5>
							</div>
						<?php endif; ?>
						<h3><?= $nbCampaign; ?> campagnes publiques synchronisées</h3>
					</div>
					<div class="ha-header-col">
						<a href="<?= admin_url(); ?>admin.php?page=hello-asso" class="ha-btn ha-btn-primary">Resynchroniser</a>
					</div>
				</div>
			</div>
			<div class="ha-campaign-list">
				<?php
				$fromTinyMce = "";
				if (isset($_GET['from']) && $_GET['from'] == "tinymce") {
					$action = 'onclick="insertIframeInTinyMce(this)"';
					$actionTinyMce = ';actionTinyMce(this)';
					$labelButton = "Insérer";
				} else {
					$action = 'onclick="haCopy(this)"';
					$actionTinyMce = '';
					$labelButton = "Copier";
				}
				?>

				<input type="hidden" class="lastUrlWidget" />
				<?php foreach ($arraySort as $key => $campaignsSort) :
					echo '<h2 class="ha-form-type">' . ${strtolower($key) . "Title"} . '<span>' . ${strtolower($key)} . '</span></h2>';
				?>
					<?php foreach ($campaignsSort as $campaign) :
						$urlCampaign = substr($campaign['widgetButtonUrl'], 0, strrpos($campaign['widgetButtonUrl'], '/')) . "/";

						$startDate = '';
						$endDate = '';

						if (isset($campaign['startDate'])) {
							$startDate = $campaign['startDate'];
						}

						if (isset($campaign['endDate'])) {
							$endDate = $campaign['endDate'];
						}
						
						$allDate = 1;

						if ($startDate == '' or $endDate == '') {
							$allDate = 0;
						}
					?>
						<div class="ha-campaign">
							<a href="<?= $campaign['url']; ?>" class="ha-link-open-shortcode" target="_blank">
								<img src="<?= plugin_dir_url(__FILE__); ?>icons/log-out-white.svg" />Voir
							</a>
							<div class="ha-campaign-info" data-type="<?= $key; ?>" data-url="<?= $campaign['widgetFullUrl']; ?>" onclick="openShortcodesCampaign(this)<?= $actionTinyMce; ?>">
								<div class="ha-date">
									<?php if ($allDate == 0) : ?>
										<?php if ($startDate != '') { ?>
											<?= date('d', strtotime($startDate)); ?> <?= $months[date('n', strtotime($startDate))]; ?> <?= date('Y', strtotime($startDate)); ?>
										<?php } elseif ($endDate != '') { ?>
											<?= date('d', strtotime($endDate)); ?> <?= $months[date('n', strtotime($endDate))]; ?> <?= date('Y', strtotime($endDate)); ?>
										<?php } else {
											echo 'Pas de date définie';
										} ?>
									<?php else : ?>
										Du <?= date('d', strtotime($startDate)); ?> <?= $months[date('n', strtotime($startDate))]; ?> <?= date('Y', strtotime($startDate)); ?>
										au <?= date('d', strtotime($endDate)); ?> <?= $months[date('n', strtotime($endDate))]; ?> <?= date('Y', strtotime($endDate)); ?>
									<?php endif; ?>

								</div>
								<div class="ha-title"><?= stripslashes($campaign['title']); ?></div>
								<div class="ha-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#BEBED7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
										<rect x="3" y="3" width="7" height="7"></rect>
										<rect x="14" y="3" width="7" height="7"></rect>
										<rect x="14" y="14" width="7" height="7"></rect>
										<rect x="3" y="14" width="7" height="7"></rect>
									</svg>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endforeach; ?>

				<?php if ($event == 0) : ?>
					<div class="ha-no-form-type">
						<h2>Billetterie</h2>
						<p>Aucune billetterie</p>
					</div>
				<?php endif; ?>
				<?php if ($membership == 0) : ?>
					<div class="ha-no-form-type">
						<h2>Adhésion</h2>
						<p>Aucune campagne d'adhésion</p>
					</div>
				<?php endif; ?>
				<?php if ($paymentform == 0) : ?>
					<div class="ha-no-form-type">
						<h2>Vente</h2>
						<p>Aucune vente</p>
					</div>
				<?php endif; ?>
				<?php if ($crowdfunding == 0) : ?>
					<div class="ha-no-form-type">
						<h2>Crowdfunding</h2>
						<p>Aucune crowdfuding</p>
					</div>
				<?php endif; ?>
				<?php if ($donation == 0) : ?>
					<div class="ha-no-form-type">
						<h2>Don</h2>
						<p>Aucune campagne de don</p>
					</div>
				<?php endif; ?>
			</div>
			<?php require_once('template/footer.php'); ?>
		</div>
		<div class="ha-campaign-right">
			<div class="ha-campaign-viewer">
				<span class="close-campaign-viewer">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15 5L5 15" stroke="#BEBED7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M5 5L15 15" stroke="#BEBED7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
				<p class="ha-description-viewer">Veuillez choisir une campagne pour afficher les widgets disponibles</p>
				<div class="ha-loader-viewer" style="display: none;">
					<svg width="200px" height="200px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ripple" style="background: none;">
						<circle cx="50" cy="50" r="25.3247" fill="none" ng-attr-stroke="{{config.c1}}" ng-attr-stroke-width="{{config.width}}" stroke="#773a7f" stroke-width="2">
							<animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="1" keySplines="0 0.2 0.8 1" begin="-0.5s" repeatCount="indefinite"></animate>
							<animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="1" keySplines="0.2 0 0.8 1" begin="-0.5s" repeatCount="indefinite"></animate>
						</circle>
						<circle cx="50" cy="50" r="39.9351" fill="none" ng-attr-stroke="{{config.c2}}" ng-attr-stroke-width="{{config.width}}" stroke="#49d38a" stroke-width="2">
							<animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="1" keySplines="0 0.2 0.8 1" begin="0s" repeatCount="indefinite"></animate>
							<animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="1" keySplines="0.2 0 0.8 1" begin="0s" repeatCount="indefinite"></animate>
						</circle>
					</svg>
				</div>
				<div class="ha-shortcodes-viewer" style="display: none;">
					<aside class="vignette">
						<p>Vue Vignette</p>
						<div class="iframe-container">
							<iframe src="" class="ha-iframe-placeholder" id="vueVignette" style="width: 350px; height: 450px;"></iframe>
						</div>
						<button type="button" class="ha-btn ha-btn-primary ha-copy" <?= $action; ?> data-type="widget-vignette">
							<img src="<?= plugin_dir_url(__FILE__); ?>icons/copy.svg" /> <?= $labelButton; ?>
							<div class="ha-tooltip" <?php if ($labelButton == "Insérer") {
														echo 'style="display:none !important;"';
													} ?>>
								<span>Copié !</span>
							</div>
						</button>
					</aside>
					<p>Vue Bouton</p>
					<div class="iframe-container">
						<iframe src="" class="ha-iframe-placeholder" id="vueBouton" style="width: 100%; height: 70px;"></iframe>
					</div>
					<button type="button" class="ha-btn ha-btn-primary ha-copy" <?= $action; ?> data-type="widget-bouton">
						<img src="<?= plugin_dir_url(__FILE__); ?>icons/copy.svg" /> <?= $labelButton; ?>
						<div class="ha-tooltip" <?php if ($labelButton == "Insérer") {
													echo 'style="display:none !important;"';
												} ?>>
							<span>Copié !</span>
						</div>
					</button>
					<p>Vue Formulaire</p>
					<div class="iframe-container">
						<iframe src="" class="ha-iframe-placeholder" id="vueForm" style="width: 100%; height: 750px;"></iframe>
					</div>
					<button type="button" class="ha-btn ha-btn-primary ha-copy" <?= $action; ?> data-type="widget">
						<img src="<?= plugin_dir_url(__FILE__); ?>icons/copy.svg" /> <?= $labelButton; ?>
						<div class="ha-tooltip" <?php if ($labelButton == "Insérer") {
													echo 'style="display:none !important;"';
												} ?>>
							<span>Copié !</span>
						</div>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>