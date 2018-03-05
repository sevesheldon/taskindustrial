<?php

class EdgeIconsIcoMoon implements iIconCollection {

	public $icons;
	public $title;
	public $param;
	public $styleUrl;

	/**
	 * @param string $title title of icon collection
	 * @param string $param param that will be used in shortcodes
	 */
	public function __construct($title = "", $param = "")
	{
		$this->icons = array();
		$this->socialIcons = array();
		$this->title = $title;
		$this->param = $param;
		$this->setIconsArray();
		$this->setSocialIconsArray();
		$this->styleUrl = EDGE_ROOT . "/css/icomoon/css/icomoon.css";
	}

	private function setIconsArray() {
		$this->icons = array(
			'' => '',
			'icomoon-icon-home' => 'icomoon-icon-home',
			'icomoon-icon-home2' => 'icomoon-icon-home2',
			'icomoon-icon-home3' => 'icomoon-icon-home3',
			'icomoon-icon-office' => 'icomoon-icon-office',
			'icomoon-icon-newspaper' => 'icomoon-icon-newspaper',
			'icomoon-icon-pencil' => 'icomoon-icon-pencil',
			'icomoon-icon-pencil2' => 'icomoon-icon-pencil2',
			'icomoon-icon-quill' => 'icomoon-icon-quill',
			'icomoon-icon-pen' => 'icomoon-icon-pen',
			'icomoon-icon-blog' => 'icomoon-icon-blog',
			'icomoon-icon-eyedropper' => 'icomoon-icon-eyedropper',
			'icomoon-icon-droplet' => 'icomoon-icon-droplet',
			'icomoon-icon-paint-format' => 'icomoon-icon-paint-format',
			'icomoon-icon-image' => 'icomoon-icon-image',
			'icomoon-icon-images' => 'icomoon-icon-images',
			'icomoon-icon-headphones' => 'icomoon-icon-headphones',
			'icomoon-icon-music' => 'icomoon-icon-music',
			'icomoon-icon-play' => 'icomoon-icon-play',
			'icomoon-icon-film' => 'icomoon-icon-film',
			'icomoon-icon-video-camera' => 'icomoon-icon-video-camera',
			'icomoon-icon-pacman' => 'icomoon-icon-pacman',
			'icomoon-icon-spades' => 'icomoon-icon-spades',
			'icomoon-icon-clubs' => 'icomoon-icon-clubs',
			'icomoon-icon-diamonds' => 'icomoon-icon-diamonds',
			'icomoon-icon-bullhorn' => 'icomoon-icon-bullhorn',
			'icomoon-icon-connection' => 'icomoon-icon-connection',
			'icomoon-icon-podcast' => 'icomoon-icon-podcast',
			'icomoon-icon-feed' => 'icomoon-icon-feed',
			'icomoon-icon-mic' => 'icomoon-icon-mic',
			'icomoon-icon-book' => 'icomoon-icon-book',
			'icomoon-icon-books' => 'icomoon-icon-books',
			'icomoon-icon-library' => 'icomoon-icon-library',
			'icomoon-icon-file-text' => 'icomoon-icon-file-text',
			'icomoon-icon-profile' => 'icomoon-icon-profile',
			'icomoon-icon-file-empty' => 'icomoon-icon-file-empty',
			'icomoon-icon-files-empty' => 'icomoon-icon-files-empty',
			'icomoon-icon-file-text2' => 'icomoon-icon-file-text2',
			'icomoon-icon-file-picture' => 'icomoon-icon-file-picture',
			'icomoon-icon-file-music' => 'icomoon-icon-file-music',
			'icomoon-icon-file-play' => 'icomoon-icon-file-play',
			'icomoon-icon-file-video' => 'icomoon-icon-file-video',
			'icomoon-icon-file-zip' => 'icomoon-icon-file-zip',
			'icomoon-icon-copy' => 'icomoon-icon-copy',
			'icomoon-icon-paste' => 'icomoon-icon-paste',
			'icomoon-icon-stack' => 'icomoon-icon-stack',
			'icomoon-icon-folder' => 'icomoon-icon-folder',
			'icomoon-icon-folder-open' => 'icomoon-icon-folder-open',
			'icomoon-icon-folder-plus' => 'icomoon-icon-folder-plus',
			'icomoon-icon-folder-minus' => 'icomoon-icon-folder-minus',
			'icomoon-icon-folder-download' => 'icomoon-icon-folder-download',
			'icomoon-icon-folder-upload' => 'icomoon-icon-folder-upload',
			'icomoon-icon-price-tag' => 'icomoon-icon-price-tag',
			'icomoon-icon-price-tags' => 'icomoon-icon-price-tags',
			'icomoon-icon-barcode' => 'icomoon-icon-barcode',
			'icomoon-icon-qrcode' => 'icomoon-icon-qrcode',
			'icomoon-icon-ticket' => 'icomoon-icon-ticket',
			'icomoon-icon-cart' => 'icomoon-icon-cart',
			'icomoon-icon-coin-dollar' => 'icomoon-icon-coin-dollar',
			'icomoon-icon-coin-euro' => 'icomoon-icon-coin-euro',
			'icomoon-icon-coin-pound' => 'icomoon-icon-coin-pound',
			'icomoon-icon-coin-yen' => 'icomoon-icon-coin-yen',
			'icomoon-icon-credit-card' => 'icomoon-icon-credit-card',
			'icomoon-icon-calculator' => 'icomoon-icon-calculator',
			'icomoon-icon-lifebuoy' => 'icomoon-icon-lifebuoy',
			'icomoon-icon-phone' => 'icomoon-icon-phone',
			'icomoon-icon-phone-hang-up' => 'icomoon-icon-phone-hang-up',
			'icomoon-icon-address-book' => 'icomoon-icon-address-book',
			'icomoon-icon-envelop' => 'icomoon-icon-envelop',
			'icomoon-icon-pushpin' => 'icomoon-icon-pushpin',
			'icomoon-icon-location' => 'icomoon-icon-location',
			'icomoon-icon-location2' => 'icomoon-icon-location2',
			'icomoon-icon-compass' => 'icomoon-icon-compass',
			'icomoon-icon-compass2' => 'icomoon-icon-compass2',
			'icomoon-icon-map' => 'icomoon-icon-map',
			'icomoon-icon-map2' => 'icomoon-icon-map2',
			'icomoon-icon-history' => 'icomoon-icon-history',
			'icomoon-icon-clock' => 'icomoon-icon-clock',
			'icomoon-icon-clock2' => 'icomoon-icon-clock2',
			'icomoon-icon-alarm' => 'icomoon-icon-alarm',
			'icomoon-icon-bell' => 'icomoon-icon-bell',
			'icomoon-icon-stopwatch' => 'icomoon-icon-stopwatch',
			'icomoon-icon-calendar' => 'icomoon-icon-calendar',
			'icomoon-icon-printer' => 'icomoon-icon-printer',
			'icomoon-icon-keyboard' => 'icomoon-icon-keyboard',
			'icomoon-icon-display' => 'icomoon-icon-display',
			'icomoon-icon-laptop' => 'icomoon-icon-laptop',
			'icomoon-icon-mobile' => 'icomoon-icon-mobile',
			'icomoon-icon-mobile2' => 'icomoon-icon-mobile2',
			'icomoon-icon-tablet' => 'icomoon-icon-tablet',
			'icomoon-icon-tv' => 'icomoon-icon-tv',
			'icomoon-icon-drawer' => 'icomoon-icon-drawer',
			'icomoon-icon-drawer2' => 'icomoon-icon-drawer2',
			'icomoon-icon-box-add' => 'icomoon-icon-box-add',
			'icomoon-icon-box-remove' => 'icomoon-icon-box-remove',
			'icomoon-icon-download' => 'icomoon-icon-download',
			'icomoon-icon-upload' => 'icomoon-icon-upload',
			'icomoon-icon-floppy-disk' => 'icomoon-icon-floppy-disk',
			'icomoon-icon-drive' => 'icomoon-icon-drive',
			'icomoon-icon-database' => 'icomoon-icon-database',
			'icomoon-icon-undo' => 'icomoon-icon-undo',
			'icomoon-icon-redo' => 'icomoon-icon-redo',
			'icomoon-icon-undo2' => 'icomoon-icon-undo2',
			'icomoon-icon-redo2' => 'icomoon-icon-redo2',
			'icomoon-icon-forward' => 'icomoon-icon-forward',
			'icomoon-icon-reply' => 'icomoon-icon-reply',
			'icomoon-icon-bubble' => 'icomoon-icon-bubble',
			'icomoon-icon-bubbles' => 'icomoon-icon-bubbles',
			'icomoon-icon-bubbles2' => 'icomoon-icon-bubbles2',
			'icomoon-icon-bubble2' => 'icomoon-icon-bubble2',
			'icomoon-icon-bubbles3' => 'icomoon-icon-bubbles3',
			'icomoon-icon-bubbles4' => 'icomoon-icon-bubbles4',
			'icomoon-icon-user' => 'icomoon-icon-user',
			'icomoon-icon-users' => 'icomoon-icon-users',
			'icomoon-icon-user-plus' => 'icomoon-icon-user-plus',
			'icomoon-icon-user-minus' => 'icomoon-icon-user-minus',
			'icomoon-icon-user-check' => 'icomoon-icon-user-check',
			'icomoon-icon-user-tie' => 'icomoon-icon-user-tie',
			'icomoon-icon-quotes-left' => 'icomoon-icon-quotes-left',
			'icomoon-icon-quotes-right' => 'icomoon-icon-quotes-right',
			'icomoon-icon-hour-glass' => 'icomoon-icon-hour-glass',
			'icomoon-icon-spinner' => 'icomoon-icon-spinner',
			'icomoon-icon-spinner2' => 'icomoon-icon-spinner2',
			'icomoon-icon-spinner3' => 'icomoon-icon-spinner3',
			'icomoon-icon-spinner4' => 'icomoon-icon-spinner4',
			'icomoon-icon-spinner5' => 'icomoon-icon-spinner5',
			'icomoon-icon-spinner6' => 'icomoon-icon-spinner6',
			'icomoon-icon-spinner7' => 'icomoon-icon-spinner7',
			'icomoon-icon-spinner8' => 'icomoon-icon-spinner8',
			'icomoon-icon-spinner9' => 'icomoon-icon-spinner9',
			'icomoon-icon-spinner10' => 'icomoon-icon-spinner10',
			'icomoon-icon-spinner11' => 'icomoon-icon-spinner11',
			'icomoon-icon-binoculars' => 'icomoon-icon-binoculars',
			'icomoon-icon-search' => 'icomoon-icon-search',
			'icomoon-icon-zoom-in' => 'icomoon-icon-zoom-in',
			'icomoon-icon-zoom-out' => 'icomoon-icon-zoom-out',
			'icomoon-icon-enlarge' => 'icomoon-icon-enlarge',
			'icomoon-icon-shrink' => 'icomoon-icon-shrink',
			'icomoon-icon-enlarge2' => 'icomoon-icon-enlarge2',
			'icomoon-icon-shrink2' => 'icomoon-icon-shrink2',
			'icomoon-icon-key' => 'icomoon-icon-key',
			'icomoon-icon-key2' => 'icomoon-icon-key2',
			'icomoon-icon-lock' => 'icomoon-icon-lock',
			'icomoon-icon-unlocked' => 'icomoon-icon-unlocked',
			'icomoon-icon-wrench' => 'icomoon-icon-wrench',
			'icomoon-icon-equalizer' => 'icomoon-icon-equalizer',
			'icomoon-icon-equalizer2' => 'icomoon-icon-equalizer2',
			'icomoon-icon-cog' => 'icomoon-icon-cog',
			'icomoon-icon-cogs' => 'icomoon-icon-cogs',
			'icomoon-icon-hammer' => 'icomoon-icon-hammer',
			'icomoon-icon-magic-wand' => 'icomoon-icon-magic-wand',
			'icomoon-icon-aid-kit' => 'icomoon-icon-aid-kit',
			'icomoon-icon-bug' => 'icomoon-icon-bug',
			'icomoon-icon-pie-chart' => 'icomoon-icon-pie-chart',
			'icomoon-icon-stats-dots' => 'icomoon-icon-stats-dots',
			'icomoon-icon-stats-bars' => 'icomoon-icon-stats-bars',
			'icomoon-icon-stats-bars2' => 'icomoon-icon-stats-bars2',
			'icomoon-icon-trophy' => 'icomoon-icon-trophy',
			'icomoon-icon-gift' => 'icomoon-icon-gift',
			'icomoon-icon-glass' => 'icomoon-icon-glass',
			'icomoon-icon-glass2' => 'icomoon-icon-glass2',
			'icomoon-icon-mug' => 'icomoon-icon-mug',
			'icomoon-icon-spoon-knife' => 'icomoon-icon-spoon-knife',
			'icomoon-icon-leaf' => 'icomoon-icon-leaf',
			'icomoon-icon-rocket' => 'icomoon-icon-rocket',
			'icomoon-icon-meter' => 'icomoon-icon-meter',
			'icomoon-icon-meter2' => 'icomoon-icon-meter2',
			'icomoon-icon-hammer2' => 'icomoon-icon-hammer2',
			'icomoon-icon-fire' => 'icomoon-icon-fire',
			'icomoon-icon-lab' => 'icomoon-icon-lab',
			'icomoon-icon-magnet' => 'icomoon-icon-magnet',
			'icomoon-icon-bin' => 'icomoon-icon-bin',
			'icomoon-icon-bin2' => 'icomoon-icon-bin2',
			'icomoon-icon-briefcase' => 'icomoon-icon-briefcase',
			'icomoon-icon-airplane' => 'icomoon-icon-airplane',
			'icomoon-icon-truck' => 'icomoon-icon-truck',
			'icomoon-icon-road' => 'icomoon-icon-road',
			'icomoon-icon-accessibility' => 'icomoon-icon-accessibility',
			'icomoon-icon-target' => 'icomoon-icon-target',
			'icomoon-icon-shield' => 'icomoon-icon-shield',
			'icomoon-icon-power' => 'icomoon-icon-power',
			'icomoon-icon-switch' => 'icomoon-icon-switch',
			'icomoon-icon-power-cord' => 'icomoon-icon-power-cord',
			'icomoon-icon-clipboard' => 'icomoon-icon-clipboard',
			'icomoon-icon-list-numbered' => 'icomoon-icon-list-numbered',
			'icomoon-icon-list' => 'icomoon-icon-list',
			'icomoon-icon-list2' => 'icomoon-icon-list2',
			'icomoon-icon-tree' => 'icomoon-icon-tree',
			'icomoon-icon-menu' => 'icomoon-icon-menu',
			'icomoon-icon-menu2' => 'icomoon-icon-menu2',
			'icomoon-icon-menu3' => 'icomoon-icon-menu3',
			'icomoon-icon-menu4' => 'icomoon-icon-menu4',
			'icomoon-icon-cloud' => 'icomoon-icon-cloud',
			'icomoon-icon-cloud-download' => 'icomoon-icon-cloud-download',
			'icomoon-icon-cloud-upload' => 'icomoon-icon-cloud-upload',
			'icomoon-icon-cloud-check' => 'icomoon-icon-cloud-check',
			'icomoon-icon-download2' => 'icomoon-icon-download2',
			'icomoon-icon-upload2' => 'icomoon-icon-upload2',
			'icomoon-icon-download3' => 'icomoon-icon-download3',
			'icomoon-icon-upload3' => 'icomoon-icon-upload3',
			'icomoon-icon-sphere' => 'icomoon-icon-sphere',
			'icomoon-icon-earth' => 'icomoon-icon-earth',
			'icomoon-icon-link' => 'icomoon-icon-link',
			'icomoon-icon-flag' => 'icomoon-icon-flag',
			'icomoon-icon-attachment' => 'icomoon-icon-attachment',
			'icomoon-icon-eye' => 'icomoon-icon-eye',
			'icomoon-icon-eye-plus' => 'icomoon-icon-eye-plus',
			'icomoon-icon-eye-minus' => 'icomoon-icon-eye-minus',
			'icomoon-icon-eye-blocked' => 'icomoon-icon-eye-blocked',
			'icomoon-icon-bookmark' => 'icomoon-icon-bookmark',
			'icomoon-icon-bookmarks' => 'icomoon-icon-bookmarks',
			'icomoon-icon-sun' => 'icomoon-icon-sun',
			'icomoon-icon-contrast' => 'icomoon-icon-contrast',
			'icomoon-icon-brightness-contrast' => 'icomoon-icon-brightness-contrast',
			'icomoon-icon-star-empty' => 'icomoon-icon-star-empty',
			'icomoon-icon-star-half' => 'icomoon-icon-star-half',
			'icomoon-icon-star-full' => 'icomoon-icon-star-full',
			'icomoon-icon-heart' => 'icomoon-icon-heart',
			'icomoon-icon-heart-broken' => 'icomoon-icon-heart-broken',
			'icomoon-icon-man' => 'icomoon-icon-man',
			'icomoon-icon-woman' => 'icomoon-icon-woman',
			'icomoon-icon-man-woman' => 'icomoon-icon-man-woman',
			'icomoon-icon-happy' => 'icomoon-icon-happy',
			'icomoon-icon-happy2' => 'icomoon-icon-happy2',
			'icomoon-icon-smile' => 'icomoon-icon-smile',
			'icomoon-icon-smile2' => 'icomoon-icon-smile2',
			'icomoon-icon-tongue' => 'icomoon-icon-tongue',
			'icomoon-icon-tongue2' => 'icomoon-icon-tongue2',
			'icomoon-icon-sad' => 'icomoon-icon-sad',
			'icomoon-icon-sad2' => 'icomoon-icon-sad2',
			'icomoon-icon-wink' => 'icomoon-icon-wink',
			'icomoon-icon-wink2' => 'icomoon-icon-wink2',
			'icomoon-icon-grin' => 'icomoon-icon-grin',
			'icomoon-icon-grin2' => 'icomoon-icon-grin2',
			'icomoon-icon-cool' => 'icomoon-icon-cool',
			'icomoon-icon-cool2' => 'icomoon-icon-cool2',
			'icomoon-icon-angry' => 'icomoon-icon-angry',
			'icomoon-icon-angry2' => 'icomoon-icon-angry2',
			'icomoon-icon-evil' => 'icomoon-icon-evil',
			'icomoon-icon-evil2' => 'icomoon-icon-evil2',
			'icomoon-icon-shocked' => 'icomoon-icon-shocked',
			'icomoon-icon-shocked2' => 'icomoon-icon-shocked2',
			'icomoon-icon-baffled' => 'icomoon-icon-baffled',
			'icomoon-icon-baffled2' => 'icomoon-icon-baffled2',
			'icomoon-icon-confused' => 'icomoon-icon-confused',
			'icomoon-icon-confused2' => 'icomoon-icon-confused2',
			'icomoon-icon-neutral' => 'icomoon-icon-neutral',
			'icomoon-icon-neutral2' => 'icomoon-icon-neutral2',
			'icomoon-icon-hipster' => 'icomoon-icon-hipster',
			'icomoon-icon-hipster2' => 'icomoon-icon-hipster2',
			'icomoon-icon-wondering' => 'icomoon-icon-wondering',
			'icomoon-icon-wondering2' => 'icomoon-icon-wondering2',
			'icomoon-icon-sleepy' => 'icomoon-icon-sleepy',
			'icomoon-icon-sleepy2' => 'icomoon-icon-sleepy2',
			'icomoon-icon-frustrated' => 'icomoon-icon-frustrated',
			'icomoon-icon-frustrated2' => 'icomoon-icon-frustrated2',
			'icomoon-icon-crying' => 'icomoon-icon-crying',
			'icomoon-icon-crying2' => 'icomoon-icon-crying2',
			'icomoon-icon-point-up' => 'icomoon-icon-point-up',
			'icomoon-icon-point-right' => 'icomoon-icon-point-right',
			'icomoon-icon-point-down' => 'icomoon-icon-point-down',
			'icomoon-icon-point-left' => 'icomoon-icon-point-left',
			'icomoon-icon-warning' => 'icomoon-icon-warning',
			'icomoon-icon-notification' => 'icomoon-icon-notification',
			'icomoon-icon-question' => 'icomoon-icon-question',
			'icomoon-icon-plus' => 'icomoon-icon-plus',
			'icomoon-icon-minus' => 'icomoon-icon-minus',
			'icomoon-icon-info' => 'icomoon-icon-info',
			'icomoon-icon-cancel-circle' => 'icomoon-icon-cancel-circle',
			'icomoon-icon-blocked' => 'icomoon-icon-blocked',
			'icomoon-icon-cross' => 'icomoon-icon-cross',
			'icomoon-icon-checkmark' => 'icomoon-icon-checkmark',
			'icomoon-icon-checkmark2' => 'icomoon-icon-checkmark2',
			'icomoon-icon-spell-check' => 'icomoon-icon-spell-check',
			'icomoon-icon-enter' => 'icomoon-icon-enter',
			'icomoon-icon-exit' => 'icomoon-icon-exit',
			'icomoon-icon-play2' => 'icomoon-icon-play2',
			'icomoon-icon-pause' => 'icomoon-icon-pause',
			'icomoon-icon-stop' => 'icomoon-icon-stop',
			'icomoon-icon-previous' => 'icomoon-icon-previous',
			'icomoon-icon-next' => 'icomoon-icon-next',
			'icomoon-icon-backward' => 'icomoon-icon-backward',
			'icomoon-icon-forward2' => 'icomoon-icon-forward2',
			'icomoon-icon-play3' => 'icomoon-icon-play3',
			'icomoon-icon-pause2' => 'icomoon-icon-pause2',
			'icomoon-icon-stop2' => 'icomoon-icon-stop2',
			'icomoon-icon-backward2' => 'icomoon-icon-backward2',
			'icomoon-icon-forward3' => 'icomoon-icon-forward3',
			'icomoon-icon-first' => 'icomoon-icon-first',
			'icomoon-icon-last' => 'icomoon-icon-last',
			'icomoon-icon-previous2' => 'icomoon-icon-previous2',
			'icomoon-icon-next2' => 'icomoon-icon-next2',
			'icomoon-icon-eject' => 'icomoon-icon-eject',
			'icomoon-icon-volume-high' => 'icomoon-icon-volume-high',
			'icomoon-icon-volume-medium' => 'icomoon-icon-volume-medium',
			'icomoon-icon-volume-low' => 'icomoon-icon-volume-low',
			'icomoon-icon-volume-mute' => 'icomoon-icon-volume-mute',
			'icomoon-icon-volume-mute2' => 'icomoon-icon-volume-mute2',
			'icomoon-icon-volume-increase' => 'icomoon-icon-volume-increase',
			'icomoon-icon-volume-decrease' => 'icomoon-icon-volume-decrease',
			'icomoon-icon-loop' => 'icomoon-icon-loop',
			'icomoon-icon-loop2' => 'icomoon-icon-loop2',
			'icomoon-icon-infinite' => 'icomoon-icon-infinite',
			'icomoon-icon-shuffle' => 'icomoon-icon-shuffle',
			'icomoon-icon-arrow-up-left' => 'icomoon-icon-arrow-up-left',
			'icomoon-icon-arrow-up' => 'icomoon-icon-arrow-up',
			'icomoon-icon-arrow-up-right' => 'icomoon-icon-arrow-up-right',
			'icomoon-icon-arrow-right' => 'icomoon-icon-arrow-right',
			'icomoon-icon-arrow-down-right' => 'icomoon-icon-arrow-down-right',
			'icomoon-icon-arrow-down' => 'icomoon-icon-arrow-down',
			'icomoon-icon-arrow-down-left' => 'icomoon-icon-arrow-down-left',
			'icomoon-icon-arrow-left' => 'icomoon-icon-arrow-left',
			'icomoon-icon-arrow-up-left2' => 'icomoon-icon-arrow-up-left2',
			'icomoon-icon-arrow-up2' => 'icomoon-icon-arrow-up2',
			'icomoon-icon-arrow-up-right2' => 'icomoon-icon-arrow-up-right2',
			'icomoon-icon-arrow-right2' => 'icomoon-icon-arrow-right2',
			'icomoon-icon-arrow-down-right2' => 'icomoon-icon-arrow-down-right2',
			'icomoon-icon-arrow-down2' => 'icomoon-icon-arrow-down2',
			'icomoon-icon-arrow-down-left2' => 'icomoon-icon-arrow-down-left2',
			'icomoon-icon-circle-up' => 'icomoon-icon-circle-up',
			'icomoon-icon-circle-right' => 'icomoon-icon-circle-right',
			'icomoon-icon-circle-down' => 'icomoon-icon-circle-down',
			'icomoon-icon-circle-left' => 'icomoon-icon-circle-left',
			'icomoon-icon-tab' => 'icomoon-icon-tab',
			'icomoon-icon-move-up' => 'icomoon-icon-move-up',
			'icomoon-icon-move-down' => 'icomoon-icon-move-down',
			'icomoon-icon-sort-alpha-asc' => 'icomoon-icon-sort-alpha-asc',
			'icomoon-icon-sort-alpha-desc' => 'icomoon-icon-sort-alpha-desc',
			'icomoon-icon-sort-numeric-asc' => 'icomoon-icon-sort-numeric-asc',
			'icomoon-icon-sort-numeric-desc' => 'icomoon-icon-sort-numeric-desc',
			'icomoon-icon-sort-amount-asc' => 'icomoon-icon-sort-amount-asc',
			'icomoon-icon-sort-amount-desc' => 'icomoon-icon-sort-amount-desc',
			'icomoon-icon-command' => 'icomoon-icon-command',
			'icomoon-icon-shift' => 'icomoon-icon-shift',
			'icomoon-icon-ctrl' => 'icomoon-icon-ctrl',
			'icomoon-icon-opt' => 'icomoon-icon-opt',
			'icomoon-icon-checkbox-checked' => 'icomoon-icon-checkbox-checked',
			'icomoon-icon-checkbox-unchecked' => 'icomoon-icon-checkbox-unchecked',
			'icomoon-icon-radio-checked' => 'icomoon-icon-radio-checked',
			'icomoon-icon-radio-checked2' => 'icomoon-icon-radio-checked2',
			'icomoon-icon-radio-unchecked' => 'icomoon-icon-radio-unchecked',
			'icomoon-icon-crop' => 'icomoon-icon-crop',
			'icomoon-icon-make-group' => 'icomoon-icon-make-group',
			'icomoon-icon-ungroup' => 'icomoon-icon-ungroup',
			'icomoon-icon-scissors' => 'icomoon-icon-scissors',
			'icomoon-icon-filter' => 'icomoon-icon-filter',
			'icomoon-icon-font' => 'icomoon-icon-font',
			'icomoon-icon-ligature' => 'icomoon-icon-ligature',
			'icomoon-icon-ligature2' => 'icomoon-icon-ligature2',
			'icomoon-icon-text-height' => 'icomoon-icon-text-height',
			'icomoon-icon-text-width' => 'icomoon-icon-text-width',
			'icomoon-icon-font-size' => 'icomoon-icon-font-size',
			'icomoon-icon-bold' => 'icomoon-icon-bold',
			'icomoon-icon-underline' => 'icomoon-icon-underline',
			'icomoon-icon-italic' => 'icomoon-icon-italic',
			'icomoon-icon-strikethrough' => 'icomoon-icon-strikethrough',
			'icomoon-icon-omega' => 'icomoon-icon-omega',
			'icomoon-icon-sigma' => 'icomoon-icon-sigma',
			'icomoon-icon-page-break' => 'icomoon-icon-page-break',
			'icomoon-icon-superscript' => 'icomoon-icon-superscript',
			'icomoon-icon-subscript' => 'icomoon-icon-subscript',
			'icomoon-icon-superscript2' => 'icomoon-icon-superscript2',
			'icomoon-icon-subscript2' => 'icomoon-icon-subscript2',
			'icomoon-icon-text-color' => 'icomoon-icon-text-color',
			'icomoon-icon-pagebreak' => 'icomoon-icon-pagebreak',
			'icomoon-icon-clear-formatting' => 'icomoon-icon-clear-formatting',
			'icomoon-icon-table' => 'icomoon-icon-table',
			'icomoon-icon-table2' => 'icomoon-icon-table2',
			'icomoon-icon-insert-template' => 'icomoon-icon-insert-template',
			'icomoon-icon-pilcrow' => 'icomoon-icon-pilcrow',
			'icomoon-icon-ltr' => 'icomoon-icon-ltr',
			'icomoon-icon-rtl' => 'icomoon-icon-rtl',
			'icomoon-icon-section' => 'icomoon-icon-section',
			'icomoon-icon-paragraph-left' => 'icomoon-icon-paragraph-left',
			'icomoon-icon-paragraph-center' => 'icomoon-icon-paragraph-center',
			'icomoon-icon-paragraph-right' => 'icomoon-icon-paragraph-right',
			'icomoon-icon-paragraph-justify' => 'icomoon-icon-paragraph-justify',
			'icomoon-icon-indent-increase' => 'icomoon-icon-indent-increase',
			'icomoon-icon-indent-decrease' => 'icomoon-icon-indent-decrease',
			'icomoon-icon-share' => 'icomoon-icon-share',
			'icomoon-icon-new-tab' => 'icomoon-icon-new-tab',
			'icomoon-icon-embed' => 'icomoon-icon-embed',
			'icomoon-icon-embed2' => 'icomoon-icon-embed2',
			'icomoon-icon-terminal' => 'icomoon-icon-terminal',
			'icomoon-icon-share2' => 'icomoon-icon-share2',
			'icomoon-icon-mail' => 'icomoon-icon-mail',
			'icomoon-icon-mail2' => 'icomoon-icon-mail2',
			'icomoon-icon-mail3' => 'icomoon-icon-mail3',
			'icomoon-icon-mail4' => 'icomoon-icon-mail4',
			'icomoon-icon-google' => 'icomoon-icon-google',
			'icomoon-icon-google-plus' => 'icomoon-icon-google-plus',
			'icomoon-icon-google-plus2' => 'icomoon-icon-google-plus2',
			'icomoon-icon-google-plus3' => 'icomoon-icon-google-plus3',
			'icomoon-icon-google-drive' => 'icomoon-icon-google-drive',
			'icomoon-icon-facebook' => 'icomoon-icon-facebook',
			'icomoon-icon-facebook2' => 'icomoon-icon-facebook2',
			'icomoon-icon-facebook3' => 'icomoon-icon-facebook3',
			'icomoon-icon-ello' => 'icomoon-icon-ello',
			'icomoon-icon-instagram' => 'icomoon-icon-instagram',
			'icomoon-icon-twitter' => 'icomoon-icon-twitter',
			'icomoon-icon-twitter2' => 'icomoon-icon-twitter2',
			'icomoon-icon-twitter3' => 'icomoon-icon-twitter3',
			'icomoon-icon-feed2' => 'icomoon-icon-feed2',
			'icomoon-icon-feed3' => 'icomoon-icon-feed3',
			'icomoon-icon-feed4' => 'icomoon-icon-feed4',
			'icomoon-icon-youtube' => 'icomoon-icon-youtube',
			'icomoon-icon-youtube2' => 'icomoon-icon-youtube2',
			'icomoon-icon-youtube3' => 'icomoon-icon-youtube3',
			'icomoon-icon-youtube4' => 'icomoon-icon-youtube4',
			'icomoon-icon-twitch' => 'icomoon-icon-twitch',
			'icomoon-icon-vimeo' => 'icomoon-icon-vimeo',
			'icomoon-icon-vimeo2' => 'icomoon-icon-vimeo2',
			'icomoon-icon-vimeo3' => 'icomoon-icon-vimeo3',
			'icomoon-icon-lanyrd' => 'icomoon-icon-lanyrd',
			'icomoon-icon-flickr' => 'icomoon-icon-flickr',
			'icomoon-icon-flickr2' => 'icomoon-icon-flickr2',
			'icomoon-icon-flickr3' => 'icomoon-icon-flickr3',
			'icomoon-icon-flickr4' => 'icomoon-icon-flickr4',
			'icomoon-icon-picassa' => 'icomoon-icon-picassa',
			'icomoon-icon-picassa2' => 'icomoon-icon-picassa2',
			'icomoon-icon-dribbble' => 'icomoon-icon-dribbble',
			'icomoon-icon-dribbble2' => 'icomoon-icon-dribbble2',
			'icomoon-icon-dribbble3' => 'icomoon-icon-dribbble3',
			'icomoon-icon-forrst' => 'icomoon-icon-forrst',
			'icomoon-icon-forrst2' => 'icomoon-icon-forrst2',
			'icomoon-icon-deviantart' => 'icomoon-icon-deviantart',
			'icomoon-icon-deviantart2' => 'icomoon-icon-deviantart2',
			'icomoon-icon-steam' => 'icomoon-icon-steam',
			'icomoon-icon-steam2' => 'icomoon-icon-steam2',
			'icomoon-icon-dropbox' => 'icomoon-icon-dropbox',
			'icomoon-icon-onedrive' => 'icomoon-icon-onedrive',
			'icomoon-icon-github' => 'icomoon-icon-github',
			'icomoon-icon-github2' => 'icomoon-icon-github2',
			'icomoon-icon-github3' => 'icomoon-icon-github3',
			'icomoon-icon-github4' => 'icomoon-icon-github4',
			'icomoon-icon-github5' => 'icomoon-icon-github5',
			'icomoon-icon-wordpress' => 'icomoon-icon-wordpress',
			'icomoon-icon-wordpress2' => 'icomoon-icon-wordpress2',
			'icomoon-icon-joomla' => 'icomoon-icon-joomla',
			'icomoon-icon-blogger' => 'icomoon-icon-blogger',
			'icomoon-icon-blogger2' => 'icomoon-icon-blogger2',
			'icomoon-icon-tumblr' => 'icomoon-icon-tumblr',
			'icomoon-icon-tumblr2' => 'icomoon-icon-tumblr2',
			'icomoon-icon-yahoo' => 'icomoon-icon-yahoo',
			'icomoon-icon-tux' => 'icomoon-icon-tux',
			'icomoon-icon-apple' => 'icomoon-icon-apple',
			'icomoon-icon-finder' => 'icomoon-icon-finder',
			'icomoon-icon-android' => 'icomoon-icon-android',
			'icomoon-icon-windows' => 'icomoon-icon-windows',
			'icomoon-icon-windows8' => 'icomoon-icon-windows8',
			'icomoon-icon-soundcloud' => 'icomoon-icon-soundcloud',
			'icomoon-icon-soundcloud2' => 'icomoon-icon-soundcloud2',
			'icomoon-icon-skype' => 'icomoon-icon-skype',
			'icomoon-icon-reddit' => 'icomoon-icon-reddit',
			'icomoon-icon-linkedin' => 'icomoon-icon-linkedin',
			'icomoon-icon-linkedin2' => 'icomoon-icon-linkedin2',
			'icomoon-icon-lastfm' => 'icomoon-icon-lastfm',
			'icomoon-icon-lastfm2' => 'icomoon-icon-lastfm2',
			'icomoon-icon-delicious' => 'icomoon-icon-delicious',
			'icomoon-icon-stumbleupon' => 'icomoon-icon-stumbleupon',
			'icomoon-icon-stumbleupon2' => 'icomoon-icon-stumbleupon2',
			'icomoon-icon-stackoverflow' => 'icomoon-icon-stackoverflow',
			'icomoon-icon-pinterest' => 'icomoon-icon-pinterest',
			'icomoon-icon-pinterest2' => 'icomoon-icon-pinterest2',
			'icomoon-icon-xing' => 'icomoon-icon-xing',
			'icomoon-icon-xing2' => 'icomoon-icon-xing2',
			'icomoon-icon-flattr' => 'icomoon-icon-flattr',
			'icomoon-icon-foursquare' => 'icomoon-icon-foursquare',
			'icomoon-icon-paypal' => 'icomoon-icon-paypal',
			'icomoon-icon-paypal2' => 'icomoon-icon-paypal2',
			'icomoon-icon-paypal3' => 'icomoon-icon-paypal3',
			'icomoon-icon-yelp' => 'icomoon-icon-yelp',
			'icomoon-icon-file-pdf' => 'icomoon-icon-file-pdf',
			'icomoon-icon-file-openoffice' => 'icomoon-icon-file-openoffice',
			'icomoon-icon-file-word' => 'icomoon-icon-file-word',
			'icomoon-icon-file-excel' => 'icomoon-icon-file-excel',
			'icomoon-icon-libreoffice' => 'icomoon-icon-libreoffice',
			'icomoon-icon-html5' => 'icomoon-icon-html5',
			'icomoon-icon-html52' => 'icomoon-icon-html52',
			'icomoon-icon-css3' => 'icomoon-icon-css3',
			'icomoon-icon-git' => 'icomoon-icon-git',
			'icomoon-icon-svg' => 'icomoon-icon-svg',
			'icomoon-icon-codepen' => 'icomoon-icon-codepen',
			'icomoon-icon-chrome' => 'icomoon-icon-chrome',
			'icomoon-icon-firefox' => 'icomoon-icon-firefox',
			'icomoon-icon-IE' => 'icomoon-icon-IE',
			'icomoon-icon-opera' => 'icomoon-icon-opera',
			'icomoon-icon-safari' => 'icomoon-icon-safari',
			'icomoon-icon-IcoMoon' => 'icomoon-icon-IcoMoon'
		);
	}

	/**
	 * Method that returns $icons property
	 * @return mixed
	 */
	public function getIconsArray()
	{
		return $this->icons;
	}

	/**
	 * Generates HTML for provided icon and parameters
	 * @param $icon string
	 * @param array $params
	 * @return mixed
	 */
	public function render($icon, $params = array())
	{
		$html = '';
		extract($params);
		$iconAttributesString = '';
		$iconClass = '';
		if (isset($icon_attributes) && count($icon_attributes)) {
			foreach ($icon_attributes as $icon_attr_name => $icon_attr_val) {
				if ($icon_attr_name === 'class') {
					$iconClass = $icon_attr_val;
					unset($icon_attributes[$icon_attr_name]);
				} else {
					$iconAttributesString .= $icon_attr_name . '="' . $icon_attr_val . '" ';
				}
			}
		}

		if (isset($before_icon) && $before_icon !== '') {
			$beforeIconAttrString = '';
			if (isset($before_icon_attributes) && count($before_icon_attributes)) {
				foreach ($before_icon_attributes as $before_icon_attr_name => $before_icon_attr_val) {
					$beforeIconAttrString .= $before_icon_attr_name . '="' . $before_icon_attr_val . '" ';
				}
			}

			$html .= '<' . $before_icon . ' ' . $beforeIconAttrString . '>';
		}

		$html .= '<span class="edgt_icon_icomoon ' . $icon . ' ' . $iconClass . '" ' . $iconAttributesString . '></span>';

		if (isset($before_icon) && $before_icon !== '') {
			$html .= '</' . $before_icon . '>';
		}

		return $html;
	}

	/**
	 * Checks if icon collection has social icons
	 * @return mixed
	 */
	public function hasSocialIcons()
	{
		return true;
	}

	private function setSocialIconsArray()
	{
		$this->socialIcons = array(
			'icomoon-icon-mail' => 'icomoon-icon-mail',
			'icomoon-icon-mail2' => 'icomoon-icon-mail2',
			'icomoon-icon-mail3' => 'icomoon-icon-mail3',
			'icomoon-icon-mail4' => 'icomoon-icon-mail4',
			'icomoon-icon-google' => 'icomoon-icon-google',
			'icomoon-icon-google-plus' => 'icomoon-icon-google-plus',
			'icomoon-icon-google-plus2' => 'icomoon-icon-google-plus2',
			'icomoon-icon-google-plus3' => 'icomoon-icon-google-plus3',
			'icomoon-icon-google-drive' => 'icomoon-icon-google-drive',
			'icomoon-icon-facebook' => 'icomoon-icon-facebook',
			'icomoon-icon-facebook2' => 'icomoon-icon-facebook2',
			'icomoon-icon-facebook3' => 'icomoon-icon-facebook3',
			'icomoon-icon-ello' => 'icomoon-icon-ello',
			'icomoon-icon-instagram' => 'icomoon-icon-instagram',
			'icomoon-icon-twitter' => 'icomoon-icon-twitter',
			'icomoon-icon-twitter2' => 'icomoon-icon-twitter2',
			'icomoon-icon-twitter3' => 'icomoon-icon-twitter3',
			'icomoon-icon-feed2' => 'icomoon-icon-feed2',
			'icomoon-icon-feed3' => 'icomoon-icon-feed3',
			'icomoon-icon-feed4' => 'icomoon-icon-feed4',
			'icomoon-icon-youtube' => 'icomoon-icon-youtube',
			'icomoon-icon-youtube2' => 'icomoon-icon-youtube2',
			'icomoon-icon-youtube3' => 'icomoon-icon-youtube3',
			'icomoon-icon-youtube4' => 'icomoon-icon-youtube4',
			'icomoon-icon-twitch' => 'icomoon-icon-twitch',
			'icomoon-icon-vimeo' => 'icomoon-icon-vimeo',
			'icomoon-icon-vimeo2' => 'icomoon-icon-vimeo2',
			'icomoon-icon-vimeo3' => 'icomoon-icon-vimeo3',
			'icomoon-icon-lanyrd' => 'icomoon-icon-lanyrd',
			'icomoon-icon-flickr' => 'icomoon-icon-flickr',
			'icomoon-icon-flickr2' => 'icomoon-icon-flickr2',
			'icomoon-icon-flickr3' => 'icomoon-icon-flickr3',
			'icomoon-icon-flickr4' => 'icomoon-icon-flickr4',
			'icomoon-icon-picassa' => 'icomoon-icon-picassa',
			'icomoon-icon-picassa2' => 'icomoon-icon-picassa2',
			'icomoon-icon-dribbble' => 'icomoon-icon-dribbble',
			'icomoon-icon-dribbble2' => 'icomoon-icon-dribbble2',
			'icomoon-icon-dribbble3' => 'icomoon-icon-dribbble3',
			'icomoon-icon-forrst' => 'icomoon-icon-forrst',
			'icomoon-icon-forrst2' => 'icomoon-icon-forrst2',
			'icomoon-icon-deviantart' => 'icomoon-icon-deviantart',
			'icomoon-icon-deviantart2' => 'icomoon-icon-deviantart2',
			'icomoon-icon-steam' => 'icomoon-icon-steam',
			'icomoon-icon-steam2' => 'icomoon-icon-steam2',
			'icomoon-icon-dropbox' => 'icomoon-icon-dropbox',
			'icomoon-icon-onedrive' => 'icomoon-icon-onedrive',
			'icomoon-icon-github' => 'icomoon-icon-github',
			'icomoon-icon-github2' => 'icomoon-icon-github2',
			'icomoon-icon-github3' => 'icomoon-icon-github3',
			'icomoon-icon-github4' => 'icomoon-icon-github4',
			'icomoon-icon-github5' => 'icomoon-icon-github5',
			'icomoon-icon-wordpress' => 'icomoon-icon-wordpress',
			'icomoon-icon-wordpress2' => 'icomoon-icon-wordpress2',
			'icomoon-icon-joomla' => 'icomoon-icon-joomla',
			'icomoon-icon-blogger' => 'icomoon-icon-blogger',
			'icomoon-icon-blogger2' => 'icomoon-icon-blogger2',
			'icomoon-icon-tumblr' => 'icomoon-icon-tumblr',
			'icomoon-icon-tumblr2' => 'icomoon-icon-tumblr2',
			'icomoon-icon-yahoo' => 'icomoon-icon-yahoo',
			'icomoon-icon-tux' => 'icomoon-icon-tux',
			'icomoon-icon-apple' => 'icomoon-icon-apple',
			'icomoon-icon-finder' => 'icomoon-icon-finder',
			'icomoon-icon-android' => 'icomoon-icon-android',
			'icomoon-icon-windows' => 'icomoon-icon-windows',
			'icomoon-icon-windows8' => 'icomoon-icon-windows8',
			'icomoon-icon-soundcloud' => 'icomoon-icon-soundcloud',
			'icomoon-icon-soundcloud2' => 'icomoon-icon-soundcloud2',
			'icomoon-icon-skype' => 'icomoon-icon-skype',
			'icomoon-icon-reddit' => 'icomoon-icon-reddit',
			'icomoon-icon-linkedin' => 'icomoon-icon-linkedin',
			'icomoon-icon-linkedin2' => 'icomoon-icon-linkedin2',
			'icomoon-icon-lastfm' => 'icomoon-icon-lastfm',
			'icomoon-icon-lastfm2' => 'icomoon-icon-lastfm2',
			'icomoon-icon-delicious' => 'icomoon-icon-delicious',
			'icomoon-icon-stumbleupon' => 'icomoon-icon-stumbleupon',
			'icomoon-icon-stumbleupon2' => 'icomoon-icon-stumbleupon2',
			'icomoon-icon-stackoverflow' => 'icomoon-icon-stackoverflow',
			'icomoon-icon-pinterest' => 'icomoon-icon-pinterest',
			'icomoon-icon-pinterest2' => 'icomoon-icon-pinterest2',
			'icomoon-icon-xing' => 'icomoon-icon-xing',
			'icomoon-icon-xing2' => 'icomoon-icon-xing2',
			'icomoon-icon-flattr' => 'icomoon-icon-flattr',
			'icomoon-icon-foursquare' => 'icomoon-icon-foursquare',
			'icomoon-icon-paypal' => 'icomoon-icon-paypal',
			'icomoon-icon-paypal2' => 'icomoon-icon-paypal2',
			'icomoon-icon-paypal3' => 'icomoon-icon-paypal3',
			'icomoon-icon-yelp' => 'icomoon-icon-yelp',
		);
	}

	public function getSocialIconsArray()
	{
		return $this->socialIcons;
	}

	public function getSocialIconsArrayVC()
	{
		return array_flip($this->getSocialIconsArray());
	}

	public function getSearchIcon() {

		return $this->render('icomoon-icon-search');
	}

	public function getSearchClose() {

		return $this->render('icomoon-icon-cross');
	}

	public function getMenuSideIcon() {

		return $this->render('icomoon-icon-menu');
	}

	public function getBackToTopIcon() {

		return $this->render('icomoon-icon-arrow-up ');
	}

	public function getMobileMenuIcon() {

		return $this->render('icomoon-icon-menu');
	}

	public function getQuoteIcon() {

		return $this->render('icomoon-icon-quotes-right');
	}

	public function getFacebookIcon() {

		return 'icomoon-icon-facebook';
	}

	public function getTwitterIcon() {

		return 'icomoon-icon-twitter';
	}

	public function getGooglePlusIcon() {

		return 'icomoon-icon-google-plus';
	}

	public function getLinkedInIcon() {

		return 'icomoon-icon-linkedin';
	}

	public function getTumblrIcon() {

		return 'icomoon-icon-tumblr ';
	}

	public function getPinterestIcon() {

		return 'icomoon-icon-pinterest';
	}

	public function getVKIcon() {

		return '';
	}
}