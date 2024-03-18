<div class="ha-page-content">
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
				<?php 
					$nbCampaign = count($campaigns);
					if(get_option('ha-error') == 0):
						if(get_option('ha-sync') > strtotime('-90 days')): ?>
							<h1><?= esc_html(stripslashes(get_option('ha-name'))); ?></h1>
							<h5>Dernière synchronisation réussie le <?= esc_html(date('d/m/Y à H:i:s', get_option('ha-sync'))); ?> </h5>
						<?php else: ?>
							<h1><?= esc_html(stripslashes(get_option('ha-name'))); ?></h1>
							<div class="ha-header-message-flex">
								<img src="<?= esc_url(plugin_dir_url( __FILE__ )); ?>icons/alert-triangle.svg" /> 
								<h5>Dernière synchronisation réussie le <?= esc_html(date('d/m/Y à H:i:s', get_option('ha-sync'))); ?>, <span class="semibold">Veuillez resynchroniser</span></h5>
							</div>
						<?php 
						endif;
					else:  
						$nbCampaign = 0; 
						?>
							<h1><?= esc_html(stripslashes(get_option('ha-name'))); ?></h1>
							<div class="ha-header-message-flex">
								<img src="<?= esc_url(plugin_dir_url( __FILE__ )); ?>icons/alert-triangle.svg" /> 
								<h5>La synchronisation a échouée</h5>
							</div>
				<?php endif; ?>
				<h3>0 HelloAsso publics</h3>
			</div>
			<div class="ha-header-col">
				<a href="<?= esc_url(admin_url()); ?>admin.php?page=hello-asso" class="ha-btn">Resynchroniser</a>
			</div>
		</div>
	</div>
	<div class="ha-error-container">
		<svg width="249" height="177" viewBox="0 0 249 177" fill="none" xmlns="http://www.w3.org/2000/svg">
			<circle cx="163.5" cy="3.5" r="2.5" stroke="#9EBCF9" stroke-width="2"/>
			<path d="M213 38.5C213.552 38.5 214 38.0523 214 37.5C214 36.9477 213.552 36.5 213 36.5V38.5ZM208 36.5C207.448 36.5 207 36.9477 207 37.5C207 38.0523 207.448 38.5 208 38.5V36.5ZM209.5 40C209.5 40.5523 209.948 41 210.5 41C211.052 41 211.5 40.5523 211.5 40H209.5ZM211.5 35C211.5 34.4477 211.052 34 210.5 34C209.948 34 209.5 34.4477 209.5 35H211.5ZM213 36.5H208V38.5H213V36.5ZM211.5 40V35H209.5V40H211.5Z" fill="#BEBED7"/>
			<path d="M94.1317 20.182C94.5222 19.7915 94.5222 19.1583 94.1317 18.7678C93.7412 18.3772 93.108 18.3772 92.7175 18.7678L94.1317 20.182ZM87.7677 23.7175C87.3772 24.108 87.3772 24.7412 87.7677 25.1317C88.1583 25.5223 88.7914 25.5223 89.1819 25.1317L87.7677 23.7175ZM92.7175 25.1317C93.108 25.5223 93.7412 25.5223 94.1317 25.1317C94.5222 24.7412 94.5222 24.108 94.1317 23.7175L92.7175 25.1317ZM89.1819 18.7678C88.7914 18.3772 88.1583 18.3772 87.7677 18.7678C87.3772 19.1583 87.3772 19.7915 87.7677 20.182L89.1819 18.7678ZM92.7175 18.7678L87.7677 23.7175L89.1819 25.1317L94.1317 20.182L92.7175 18.7678ZM94.1317 23.7175L89.1819 18.7678L87.7677 20.182L92.7175 25.1317L94.1317 23.7175Z" fill="#BEBED7"/>
			<path d="M34 67.5C32.25 67.5 30.5 65.75 30.5 64C30.5 65.75 28.75 67.5 27 67.5C28.75 67.5 30.5 69.25 30.5 71C30.5 69.25 32.25 67.5 34 67.5Z" fill="#9EBCF9"/>
			<path d="M117 43.5C115.25 43.5 113.5 41.75 113.5 40C113.5 41.75 111.75 43.5 110 43.5C111.75 43.5 113.5 45.25 113.5 47C113.5 45.25 115.25 43.5 117 43.5Z" fill="#777D9C"/>
			<path d="M18 112H231.5" stroke="#2E2F5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M107.162 75.7442L87 99L109.5 112L132 99L111.838 75.7442C111.351 75.1628 110.201 74 109.5 74C108.799 74 107.649 75.1628 107.162 75.7442Z" fill="white"/>
			<path d="M109.5 94.5833V74C110.256 74 111.284 74.8444 111.704 75.2667L143.5 112H124.611L109.5 94.5833Z" fill="#EBEBF3"/>
			<path d="M107.162 75.7442L87 99L109.5 112L132 99L111.838 75.7442C111.351 75.1628 110.201 74 109.5 74C108.799 74 107.649 75.1628 107.162 75.7442Z" stroke="#2E2F5E" stroke-width="2"/>
			<path d="M67.4065 72L33 112H109.791L75.3849 72C74.5538 71 72.5924 69 71.3957 69C70.1989 69 68.2376 71 67.4065 72Z" fill="white"/>
			<path d="M71 92.2917V69C71.8667 69 73.0463 69.9556 73.5278 70.4333L110 112H88.3333L71 92.2917Z" fill="#EBEBF3"/>
			<path d="M67.4065 72L33 112H109.791L75.3849 72C74.5538 71 72.5924 69 71.3957 69C70.1989 69 68.2376 71 67.4065 72Z" stroke="#2E2F5E" stroke-width="2"/>
			<path d="M157.942 56.186L110 112H217L169.058 56.186C167.9 54.7907 165.168 52 163.5 52C161.832 52 159.1 54.7907 157.942 56.186Z" fill="white"/>
			<path d="M163.5 84.5V52C164.7 52 166.333 53.3333 167 54L217.5 112H187.5L163.5 84.5Z" fill="#EBEBF3"/>
			<path d="M157.942 56.186L110 112H217L169.058 56.186C167.9 54.7907 165.168 52 163.5 52C161.832 52 159.1 54.7907 157.942 56.186Z" stroke="#2E2F5E" stroke-width="2"/>
			<path d="M97 124C96.4477 124 96 124.448 96 125C96 125.552 96.4477 126 97 126V124ZM111 126C111.552 126 112 125.552 112 125C112 124.448 111.552 124 111 124V126ZM97 126H111V124H97V126Z" fill="#BEBED7"/>
			<circle cx="115" cy="125" r="1" fill="#BEBED7"/>
			<path d="M129 142C128.448 142 128 142.448 128 143C128 143.552 128.448 144 129 144V142ZM158 144C158.552 144 159 143.552 159 143C159 142.448 158.552 142 158 142V144ZM129 144H158V142H129V144Z" fill="#BEBED7"/>
			<circle cx="162" cy="143" r="1" fill="#BEBED7"/>
			<path d="M1 130C0.447715 130 0 130.448 0 131C0 131.552 0.447715 132 1 132V130ZM30 132C30.5523 132 31 131.552 31 131C31 130.448 30.5523 130 30 130V132ZM1 132H30V130H1V132Z" fill="#BEBED7"/>
			<circle cx="34" cy="131" r="1" fill="#BEBED7"/>
			<path d="M207 165C206.448 165 206 165.448 206 166C206 166.552 206.448 167 207 167V165ZM221 167C221.552 167 222 166.552 222 166C222 165.448 221.552 165 221 165V167ZM207 167H221V165H207V167Z" fill="#BEBED7"/>
			<circle cx="225" cy="166" r="1" fill="#BEBED7"/>
			<path d="M27 153C26.4477 153 26 153.448 26 154C26 154.552 26.4477 155 27 155V153ZM41 155C41.5523 155 42 154.552 42 154C42 153.448 41.5523 153 41 153V155ZM27 155H41V153H27V155Z" fill="#BEBED7"/>
			<circle cx="45" cy="154" r="1" fill="#BEBED7"/>
			<path d="M109 163C108.448 163 108 163.448 108 164C108 164.552 108.448 165 109 165V163ZM129 165C129.552 165 130 164.552 130 164C130 163.448 129.552 163 129 163V165ZM109 165H129V163H109V165Z" fill="#BEBED7"/>
			<path d="M228 131C227.448 131 227 131.448 227 132C227 132.552 227.448 133 228 133V131ZM248 133C248.552 133 249 132.552 249 132C249 131.448 248.552 131 248 131V133ZM228 133H248V131H228V133Z" fill="#BEBED7"/>
			<mask id="path-28-inside-1" fill="white">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M185.577 116C183.941 116 182.615 117.326 182.615 118.962V129.846H179.923V126.038C179.923 124.403 178.597 123.077 176.962 123.077C175.326 123.077 174 124.403 174 126.038V132.808C174 134.443 175.326 135.769 176.962 135.769H182.615V149H188.538V139.692H194.038C194.286 139.692 194.526 139.662 194.756 139.605C196.045 139.284 197 138.119 197 136.731V129.962C197 128.326 195.674 127 194.039 127C192.403 127 191.077 128.326 191.077 129.962V133.769H188.538V118.962C188.538 117.326 187.212 116 185.577 116Z"/>
			</mask>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M185.577 116C183.941 116 182.615 117.326 182.615 118.962V129.846H179.923V126.038C179.923 124.403 178.597 123.077 176.962 123.077C175.326 123.077 174 124.403 174 126.038V132.808C174 134.443 175.326 135.769 176.962 135.769H182.615V149H188.538V139.692H194.038C194.286 139.692 194.526 139.662 194.756 139.605C196.045 139.284 197 138.119 197 136.731V129.962C197 128.326 195.674 127 194.039 127C192.403 127 191.077 128.326 191.077 129.962V133.769H188.538V118.962C188.538 117.326 187.212 116 185.577 116Z" fill="#49D38A"/>
			<path d="M182.615 129.846V131.846H184.615V129.846H182.615ZM179.923 129.846H177.923V131.846H179.923V129.846ZM182.615 135.769H184.615V133.769H182.615V135.769ZM182.615 149H180.615V151H182.615V149ZM188.538 149V151H190.538V149H188.538ZM188.538 139.692V137.692H186.538V139.692H188.538ZM194.756 139.605L194.273 137.664L194.273 137.664L194.756 139.605ZM191.077 133.769V135.769H193.077V133.769H191.077ZM188.538 133.769H186.538V135.769H188.538V133.769ZM184.615 118.962C184.615 118.43 185.046 118 185.577 118V114C182.837 114 180.615 116.221 180.615 118.962H184.615ZM184.615 129.846V118.962H180.615V129.846H184.615ZM182.615 127.846H179.923V131.846H182.615V127.846ZM181.923 129.846V126.038H177.923V129.846H181.923ZM181.923 126.038C181.923 123.298 179.702 121.077 176.962 121.077V125.077C177.493 125.077 177.923 125.507 177.923 126.038H181.923ZM176.962 121.077C174.221 121.077 172 123.298 172 126.038H176C176 125.507 176.43 125.077 176.962 125.077V121.077ZM172 126.038V132.808H176V126.038H172ZM172 132.808C172 135.548 174.221 137.769 176.962 137.769V133.769C176.43 133.769 176 133.339 176 132.808H172ZM176.962 137.769H182.615V133.769H176.962V137.769ZM184.615 149V135.769H180.615V149H184.615ZM188.538 147H182.615V151H188.538V147ZM186.538 139.692V149H190.538V139.692H186.538ZM188.538 141.692H194.038V137.692H188.538V141.692ZM194.038 141.692C194.45 141.692 194.853 141.642 195.24 141.545L194.273 137.664C194.2 137.682 194.122 137.692 194.038 137.692V141.692ZM195.24 141.545C197.398 141.008 199 139.059 199 136.731H195C195 137.179 194.692 137.56 194.273 137.664L195.24 141.545ZM199 136.731V129.962H195V136.731H199ZM199 129.962C199 127.221 196.779 125 194.039 125V129C194.57 129 195 129.43 195 129.962H199ZM194.039 125C191.298 125 189.077 127.221 189.077 129.962H193.077C193.077 129.43 193.507 129 194.039 129V125ZM189.077 129.962V133.769H193.077V129.962H189.077ZM191.077 131.769H188.538V135.769H191.077V131.769ZM186.538 118.962V133.769H190.538V118.962H186.538ZM185.577 118C186.108 118 186.538 118.43 186.538 118.962H190.538C190.538 116.221 188.317 114 185.577 114V118Z" fill="#2E2F5E" mask="url(#path-28-inside-1)"/>
			<path d="M178.385 147.154C177.832 147.154 177.385 147.602 177.385 148.154C177.385 148.706 177.832 149.154 178.385 149.154V147.154ZM192.769 149.154C193.322 149.154 193.769 148.706 193.769 148.154C193.769 147.602 193.322 147.154 192.769 147.154V149.154ZM178.385 149.154H192.769V147.154H178.385V149.154Z" fill="#2E2F5E"/>
			<mask id="path-31-inside-2" fill="white">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M70.4232 132C68.1929 132 66.3848 133.808 66.3848 136.038V148.154H64.0771V142.962C64.0771 140.731 62.269 138.923 60.0386 138.923C57.8082 138.923 56.0002 140.731 56.0002 142.962V152.175L56.0001 152.192C56.0001 154.423 57.8082 156.231 60.0386 156.231H66.3848V177H74.4617V164.308H81.9319L81.9613 164.308C83.7234 164.308 85.222 163.179 85.7735 161.605C85.9201 161.187 85.9998 160.737 85.9998 160.269L85.9998 160.252V151.038C85.9998 148.808 84.1917 147 81.9613 147C79.731 147 77.9229 148.808 77.9229 151.039V156.231H74.4617V136.038C74.4617 133.808 72.6536 132 70.4232 132Z"/>
			</mask>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M70.4232 132C68.1929 132 66.3848 133.808 66.3848 136.038V148.154H64.0771V142.962C64.0771 140.731 62.269 138.923 60.0386 138.923C57.8082 138.923 56.0002 140.731 56.0002 142.962V152.175L56.0001 152.192C56.0001 154.423 57.8082 156.231 60.0386 156.231H66.3848V177H74.4617V164.308H81.9319L81.9613 164.308C83.7234 164.308 85.222 163.179 85.7735 161.605C85.9201 161.187 85.9998 160.737 85.9998 160.269L85.9998 160.252V151.038C85.9998 148.808 84.1917 147 81.9613 147C79.731 147 77.9229 148.808 77.9229 151.039V156.231H74.4617V136.038C74.4617 133.808 72.6536 132 70.4232 132Z" fill="#49D38A"/>
			<path d="M66.3848 148.154V150.154H68.3848V148.154H66.3848ZM64.0771 148.154H62.0771V150.154H64.0771V148.154ZM56.0002 152.175L58.0002 152.179V152.175H56.0002ZM56.0001 152.192L54.0001 152.188V152.192H56.0001ZM66.3848 156.231H68.3848V154.231H66.3848V156.231ZM66.3848 177H64.3848V179H66.3848V177ZM74.4617 177V179H76.4617V177H74.4617ZM74.4617 164.308V162.308H72.4617V164.308H74.4617ZM81.9319 164.308L81.9392 162.308H81.9319V164.308ZM81.9613 164.308L81.9541 166.308H81.9613V164.308ZM85.7735 161.605L83.8861 160.944L83.8861 160.944L85.7735 161.605ZM85.9998 160.269H87.9998L87.9998 160.265L85.9998 160.269ZM85.9998 160.252H83.9998L83.9998 160.256L85.9998 160.252ZM77.9229 156.231V158.231H79.9229V156.231H77.9229ZM74.4617 156.231H72.4617V158.231H74.4617V156.231ZM68.3848 136.038C68.3848 134.913 69.2974 134 70.4232 134V130C67.0883 130 64.3848 132.704 64.3848 136.038H68.3848ZM68.3848 148.154V136.038H64.3848V148.154H68.3848ZM66.3848 146.154H64.0771V150.154H66.3848V146.154ZM66.0771 148.154V142.962H62.0771V148.154H66.0771ZM66.0771 142.962C66.0771 139.627 63.3736 136.923 60.0386 136.923V140.923C61.1644 140.923 62.0771 141.836 62.0771 142.962H66.0771ZM60.0386 136.923C56.7037 136.923 54.0002 139.627 54.0002 142.962H58.0002C58.0002 141.836 58.9128 140.923 60.0386 140.923V136.923ZM54.0002 142.962V152.175H58.0002V142.962H54.0002ZM54.0002 152.171L54.0001 152.188L58.0001 152.196L58.0002 152.179L54.0002 152.171ZM54.0001 152.192C54.0001 155.527 56.7036 158.231 60.0386 158.231V154.231C58.9128 154.231 58.0001 153.318 58.0001 152.192H54.0001ZM60.0386 158.231H66.3848V154.231H60.0386V158.231ZM68.3848 177V156.231H64.3848V177H68.3848ZM74.4617 175H66.3848V179H74.4617V175ZM72.4617 164.308V177H76.4617V164.308H72.4617ZM81.9319 162.308H74.4617V166.308H81.9319V162.308ZM81.9686 162.308L81.9392 162.308L81.9247 166.308L81.9541 166.308L81.9686 162.308ZM83.8861 160.944C83.6068 161.741 82.8477 162.308 81.9613 162.308V166.308C84.5992 166.308 86.8372 164.617 87.661 162.267L83.8861 160.944ZM83.9998 160.269C83.9998 160.509 83.9592 160.735 83.8861 160.944L87.6609 162.267C87.881 161.639 87.9998 160.966 87.9998 160.269H83.9998ZM83.9998 160.256L83.9998 160.273L87.9998 160.265L87.9998 160.248L83.9998 160.256ZM83.9998 151.038V160.252H87.9998V151.038H83.9998ZM81.9613 149C83.0871 149 83.9998 149.913 83.9998 151.038H87.9998C87.9998 147.704 85.2963 145 81.9613 145V149ZM79.9229 151.039C79.9229 149.913 80.8355 149 81.9613 149V145C78.6264 145 75.9229 147.704 75.9229 151.039H79.9229ZM79.9229 156.231V151.039H75.9229V156.231H79.9229ZM74.4617 158.231H77.9229V154.231H74.4617V158.231ZM72.4617 136.038V156.231H76.4617V136.038H72.4617ZM70.4232 134C71.549 134 72.4617 134.913 72.4617 136.038H76.4617C76.4617 132.704 73.7582 130 70.4232 130V134Z" fill="#2E2F5E" mask="url(#path-31-inside-2)"/>
			<path d="M60 175C59.4477 175 59 175.448 59 176C59 176.552 59.4477 177 60 177V175ZM80.2692 177C80.8215 177 81.2692 176.552 81.2692 176C81.2692 175.448 80.8215 175 80.2692 175V177ZM60 177H80.2692V175H60V177Z" fill="#2E2F5E"/>
		</svg>
		<h3>Aucune campagne HelloAsso publique trouvée</h3>
		<p>Créez en une en moins de 5 min.</p>
		<a href="https://www.helloasso.com/utilisateur/redirection-backoffice" class="ha-btn ha-btn-secondary" target="_blank"><img src="<?=  esc_html(plugin_dir_url( __FILE__ )); ?>icons/log-out.svg" />Créer un HelloAsso</a>
		<p>Besoin d'aide ? <a href="https://www.helloasso.com/contactez-nous" target="_blank">Contactez notre support.</a><p>
	</div>

	<?php require_once('template/footer.php'); ?>
</div>
