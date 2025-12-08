<style type="text/css">
	#wpcontent,
	#wpfooter {
		padding: 0;
		font-family: "Open Sans", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		font-size: 14px;
		font-weight: 400;
		font-display: fallback;
		line-height: 1.428571429;
		background: #F4F6FA;
	}

	#wpfooter {
		display: none;
	}

	@media (max-width: 782px) {
		.auto-fold #wpcontent {
			padding: 0;
		}

		#wpbody-content {
			padding-bottom: 75px;
		}
	}
</style>

<div class="ha-header">
	<div class="ha-header-row">
		<div class="ha-header-col">
			<h1>Recoltez facilement de l'argent pour</h1>
			<h2><span id="typed"></span></h2>
		</div>
		<div class="ha-header-col">
			<a href="https://www.helloasso.com/associations/?utm_source=HA_Widget&utm_medium=Wordpress&utm_campaign=Widget_Wordpress" target="_blank" class="ha-btn ha-btn-primary">En savoir plus</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	new Typed('#typed', {
		strings: ["un événement ponctuel", "une activité régulière", "une activité régulière", "la vente d'un produit", "la vente d'un service"],
		typeSpeed: 80,
		backSpeed: 70,
		loop: true
	})
</script>
<style type="text/css">
	.typed-cursor {
		color: white;
		font-weight: normal;
	}
</style>

<div class="ha-container ha-container-dashboard">
	<div class="ha-col">
		<span class="ha-before-block">Vous administrez une association sur HelloAsso ?</span>
		<div class="ha-blocks">
			<div class="ha-block-white">
				<div class="ha-description">
				<h3 class="ha-title-block">Récupérez toutes vos campagnes en 1 clic</h3>
					<p>Coller le slug de votre association qui se trouve dans l'URL de votre association</p>
					<p>Exemple : <b>https://admin.helloasso.com/club-de-judo/accueil</b>  le slug ici est <b>club-de-judo</b></p>
				</div>
				<div class="ha-search-glob">
					<input type="search" class="ha-search" onkeyup="haCheckInput()" value="<?= esc_html(get_option('ha-slug')); ?>" placeholder="Slug de mon association">
					<span onclick="haResetInput()" class="ha-search-delete">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 5L5 15" stroke="#BEBED7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M5 5L15 15" stroke="#BEBED7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</span>
					<!-- <label for="ha-sandbox-checkbox" class="ha-sandbox-label ha-form-group">	
						<input type="checkbox" class="ha-checkbox" id="ha-sandbox-checkbox">
						Mode bac à sable
					</label> -->
				
				</div>
				<button class="ha-btn ha-btn-primary searchCampaign" <?php if (get_option('ha-slug') == '') {
																			echo 'disabled';
																		} ?> onclick="searchCampaign()">Synchroniser</button>
				<div class="ha-no-sync ha-error ha-message" <?php if (get_option('ha-slug') != '') : ?> style="display: none;" <?php endif; ?>>
					<div class="ha-message-flex">
						<img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/alert-triangle.svg" />
						<span>Aucune synchronisation</span>
					</div>
				</div>
				<div class="ha-no-valid">
					<div class="ha-message-flex">
						<img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/alert-triangle.svg" />
						Veuillez saisir le nom d'un organisme ou un lien compatible avec le site HelloAsso
					</div>
				</div>
				<!-- <div class="ha-sync ha-loader">
					<div class="ha-message-flex">
						Synchronisation en cours...
					</div>
				</div> -->
				<?php if (get_option('ha-slug') != '') :
					if (get_option('ha-error') == 0) :
						if (get_option('ha-sync') > strtotime('-90 days')) : ?>
							<div class="ha-sync-date ha-message">
								<div class="ha-message-flex">
									<img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/check.svg" />
									Dernière synchronisation le <?= esc_html(date('d/m/Y à H:i:s', get_option('ha-sync'))); ?>
								</div>
							</div>
						<?php else : ?>
							<div class="ha-resync ha-message">
								<div class="ha-message-flex">
									<img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/alert-triangle.svg" />
									Dernière synchronisation le <?= esc_html(date('d/m/Y à H:i:s', get_option('ha-sync'))); ?>. <span class="semibold">Veuillez resynchroniser.</span>
								</div>
							</div>
						<?php endif; ?>
					<?php else : ?>
						<div class="ha-error ha-message">
							<div class="ha-message-flex">
								<img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/alert-triangle.svg" />
								<span>Veuillez saisir un autre nom d'organisme ou contacter le support HelloAsso.</span>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php if (get_option('ha-slug') != '') :
				$campaign = get_option('ha-campaign');
				$nbCampaign = 0;

				if ($campaign == '') {
					$nbCampaign = 0;
				} else {

					foreach ($campaign as $key => $campain) :

						if (isset($campain['endDate']) && strlen($campain['endDate']) > 4) {
							if (time() > strtotime($campain['endDate'])) {
								$incrementArray = 0;
							} else {
								$incrementArray = 1;
							}
						} else {
							$incrementArray = 1;
						}

						if (strtolower($campain['formType']) == "event") {

							if (isset($campain['startDate']) && time() > strtotime($campain['startDate'])) {
								$incrementArray = 0;
							} else {
								$incrementArray = 1;
							}
						}

						if ($incrementArray == 1) {
							$nbCampaign++;
						}

					endforeach;
				}
				if (get_option('ha-error') == 1) {
					$nbCampaign = 0;
				}
			?>

				<div class="ha-block-white">
					<div class="ha-count">
						<div class="ha-number-count"><?= esc_html($nbCampaign); ?></div>
						<div class="ha-description-count">
							<?= esc_html(_n(
								'campagne publique rattachée à votre association',
								'campagnes publiques rattachées à votre association',
								$nbCampaign,
								'hello-asso'
							)); ?>
						</div>
					</div>
					<?php
					$campaign = get_option('ha-campaign');

					if (get_option('ha-slug') == '') {
						$pageWidget = "ha-no-sync";
					} else {
						if (($nbCampaign == 0 or $campaign == '') && get_option('ha-error') == 0) {
							$pageWidget = "ha-no-campaign";
						} elseif (get_option('ha-error') != 0) {
							$pageWidget = "ha-no-sync";
						} else {
							$pageWidget = "ha-campaign";
						}
					}
					?>
					<a href="<?= esc_url(admin_url()); ?>admin.php?page=<?= esc_html($pageWidget); ?>" class="ha-btn ha-btn-secondary"><img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/box.svg" /> Accéder à mes widgets </a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="ha-col">
		<span class="ha-before-block">Pas encore de compte HelloAsso ?</span>
		<div class="ha-blocks">
			<div class="ha-block-white ha-line-after">
				<div class="ha-steps">
					<div class="ha-steps-number">1</div>
					<h3 class="ha-title-block">Créer votre compte </h3>
				</div>
				<a href="https://www.helloasso.com/associations/?utm_source=HA_Widget&utm_medium=Wordpress&utm_campaign=Widget_Wordpress" target="blank" class="ha-btn ha-btn-secondary"><img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/log-out.svg" /> Inscrire mon association</a>
			</div>
			<div class="ha-block-white ha-line-after">
				<div class="ha-steps">
					<div class="ha-steps-number">2</div>
					<h3 class="ha-title-block">Créer votre campagne pour récolter de l'argent en ligne</h3>
				</div>
				<a href="https://www.helloasso.com/utilisateur/redirection-backoffice?utm_source=HA_Widget&utm_medium=Wordpress&utm_campaign=Widget_Wordpress" target="blank" class="ha-btn ha-btn-secondary"><img src="<?= esc_url(plugin_dir_url(__FILE__)); ?>icons/settings.svg" /> Paramétrer vos campagnes</a>
			</div>
			<div class="ha-block-white">
				<div class="ha-steps">
					<div class="ha-steps-number">3</div>
					<div class="ha-description">
						<h3 class="ha-title-block">Synchroniser vos campagnes sur WordPress</h3>
						<p>et récupérez vos formulaires pour les intégrer dans un article !</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('template/footer.php'); ?>