<?php
/**
 * Class Elite_Video_Player_Sources_Checks
 * Replace main elite video player for our
 *
 * @since 1.0.0
 */

class Elite_Video_Player_Sources_Player {

	/**
	 * Replace old video player shortcode and add ours
	 *
	 * @since 1.0.0
	 */
	public function init() {

		remove_shortcode( 'Elite_video_player' );
		add_shortcode( 'Elite_video_player', array( $this, 'replaced_player' ) );

	}

	/**
	 * Show player by shortcode
	 *
	 * @since 1.0.0
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function replaced_player( $atts ) {

		$args = shortcode_atts(
			array(
				'id'                          => '-1',
				'videoratio'                  => '-1',
				'googleanalyticstrackingcode' => '-1',
				'instancetheme'               => '-1',
				'playerlayout'                => '-1',
				'videoplayerwidth'            => '-1',
				'videoplayerheight'           => '-1',
				'videoratiostretch'           => '-1',
				'iosplaysinline'              => '-1',
				'floatplayeroutsideviewport'  => '-1',
				'lightbox'                    => '-1',
				'lightboxautoplay'            => '-1',
				'lightboxthumbnail'           => '-1',
				'lightboxthumbnailwidth'      => '-1',
				'lightboxthumbnailheight'     => '-1',
				'lightboxcloseonoutsideclick' => '-1',
				'videoplayershadow'           => '-1',
				'playlist'                    => '-1',
				'playlistbehaviouronpageload' => '-1',
				'youtubecontrols'             => '-1',
				'youtubequality'              => '-1',
				'youtubeshowrelatedvideos'    => '-1',
				'vimeocolor'                  => '-1',
				'coloraccent'                 => '-1',
				'onfinish'                    => '-1',
				'autoplay'                    => '-1',
				'loadrandomvideoonstart'      => '-1',
				'posterimg'                   => '-1',
				'posterimgonvideofinish'      => '-1',
				'html5videoquality'           => '-1',
				'preloadselfhosted'           => '-1',
				'hidevideosource'             => '-1',
				'showallcontrols'             => '-1',
				'rightclickmenu'              => '-1',
				'ccshowonhtml5videos'         => '-1',
				'ccshownnvideoload'           => '-1',
				'autohidecontrols'            => '-1',
				'hidecontrolsonmouseout'      => '-1',
				'shuffle'                     => '-1',
				'playlistscrolltype'          => '-1',
				'nowplayingtext'              => '-1',
				'rewindshow'                  => '-1',
				'qualityshow'                 => '-1',
				'infoshow'                    => '-1',
				'shareshow'                   => '-1',
				'facebookshow'                => '-1',
				'twittershow'                 => '-1',
				'logoshow'                    => '-1',
				'logopath'                    => '-1',
				'logoposition'                => '-1',
				'logoclickable'               => '-1',
				'logogotolink'                => '-1',
				'allowskipad'                 => '-1',
				'embedshow'                   => '-1',
				'showglobalprerollads'        => '-1',
				'globalprerollads'            => '-1',
				'globalprerolladsskiptimer'   => '-1',
				'globalprerolladsgotolink'    => '-1',
				'videotype'                   => '-1',
				'html5videos_sd'              => '-1',
				'html5videos_hd'              => '-1',
				'html5videos_title'           => '-1',
				'html5videos_description'     => '-1',
				'html5videos_thumb'           => '-1',
				'html5videos_info'            => '-1',
				'html5videos_captions'        => '-1',
				'prerolls'                    => '-1',
				'prerolls_skipseconds'        => '-1',
				'prerolls_redirectonclick'    => '-1',
				'midrolls'                    => '-1',
				'midrolls_displaytime'        => '-1',
				'midrolls_skipseconds'        => '-1',
				'midrolls_redirectonclick'    => '-1',
				'postrolls'                   => '-1',
				'postrolls_skipseconds'       => '-1',
				'postrolls_redirectonclick'   => '-1',
				'popups'                      => '-1',
				'popups_displaytime'          => '-1',
				'popups_hidetime'             => '-1',
				'popups_redirectonclick'      => '-1',
				'youtubevideos'               => '-1',
				'vimeovideos'                 => '-1',
				'youtubeplaylistid'           => '-1',
				'youtubechannelid'            => '-1',
			),
			$atts
		);

		wp_enqueue_script( "elite_embed", plugins_url() . "/Elite-video-player/js/embed.min.js", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_hls", "https://cdn.jsdelivr.net/npm/hls.js@latest", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_jquery.mCustomScrollbar", plugins_url() . "/Elite-video-player/js/jquery.mCustomScrollbar.min.js", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_Froogaloop2", plugins_url() . "/Elite-video-player/js/froogaloop.min.js", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_THREEx.FullScreen", plugins_url() . "/Elite-video-player/js/THREEx.FullScreen.min.js", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_playlist", plugins_url() . "/Elite-video-player/js/Playlist.min.js", array( 'jquery' ), ELITE_PLAYER_VERSION );
		wp_enqueue_script( "elite_video_player", plugins_url() . "/Elite-video-player/js/videoPlayer.min.js", array(), ELITE_PLAYER_VERSION );

		wp_enqueue_style( 'elite_player_style', plugins_url() . "/Elite-video-player/css/elite.min.css", array(), ELITE_PLAYER_VERSION );
		wp_enqueue_style( 'elite_player_icons', plugins_url() . "/Elite-video-player/css/elite-font-awesome.min.css", array(), ELITE_PLAYER_VERSION );
		wp_enqueue_style( 'elite_player_scrollbar', plugins_url() . "/Elite-video-player/css/jquery.mCustomScrollbar.min.css", array(), ELITE_PLAYER_VERSION );

		$elite_id                   = (int) $args['id'];
		$elite_players              = get_option( 'elite_players' );
		$elite_player               = $elite_players[ $elite_id ];
		$elite_player['rootFolder'] = plugins_url() . "/Elite-video-player/";

		foreach ( $args as $key => $val ) {

			if ( $val != - 1 ) {

				if ( $key == 'videoratio' ) {
					$key = 'videoRatio';
				}
				if ( $key == 'googleanalyticstrackingcode' ) {
					$key = 'googleAnalyticsTrackingCode';
				}
				if ( $key == 'instancetheme' ) {
					$key = 'instanceTheme';
				}
				if ( $key == 'playerlayout' ) {
					$key = 'playerLayout';
				}
				if ( $key == 'videoplayerwidth' ) {
					$key = 'videoPlayerWidth';
				}
				if ( $key == 'videoplayerheight' ) {
					$key = 'videoPlayerHeight';
				}
				if ( $key == 'videoratiostretch' ) {
					$key = 'videoRatioStretch';
				}
				if ( $key == 'iosplaysinline' ) {
					$key = 'iOSPlaysinline';
				}
				if ( $key == 'floatplayeroutsideviewport' ) {
					$key = 'floatPlayerOutsideViewport';
				}
				if ( $key == 'lightbox' ) {
					$key = 'lightBox';
				}
				if ( $key == 'lightboxautoplay' ) {
					$key = 'lightBoxAutoplay';
				}
				if ( $key == 'lightboxthumbnail' ) {
					$key = 'lightBoxThumbnail';
				}
				if ( $key == 'lightboxthumbnailwidth' ) {
					$key = 'lightBoxThumbnailWidth';
				}
				if ( $key == 'lightboxthumbnailheight' ) {
					$key = 'lightBoxThumbnailHeight';
				}
				if ( $key == 'lightboxcloseonoutsideclick' ) {
					$key = 'lightBoxCloseOnOutsideClick';
				}
				if ( $key == 'videoplayershadow' ) {
					$key = 'videoPlayerShadow';
				}
				if ( $key == 'playlist' ) {
					$key = 'playlist';
				}
				if ( $key == 'playlistbehaviouronpageload' ) {
					$key = 'playlistBehaviourOnPageload';
				}
				if ( $key == 'youtubecontrols' ) {
					$key = 'youtubeControls';
				}
				if ( $key == 'youtubequality' ) {
					$key = 'youtubeQuality';
				}
				if ( $key == 'youtubeshowrelatedvideos' ) {
					$key = 'youtubeShowRelatedVideos';
				}
				if ( $key == 'vimeocolor' ) {
					$key = 'vimeoColor';
				}
				if ( $key == 'coloraccent' ) {
					$key = 'colorAccent';
				}
				if ( $key == 'onfinish' ) {
					$key = 'onFinish';
				}
				if ( $key == 'autoplay' ) {
					$key = 'autoplay';
				}
				if ( $key == 'loadrandomvideoonstart' ) {
					$key = 'loadRandomVideoOnStart';
				}
				if ( $key == 'posterimg' ) {
					$key = 'posterImg';
				}
				if ( $key == 'posterimgonvideofinish' ) {
					$key = 'posterImgOnVideoFinish';
				}
				if ( $key == 'html5videoquality' ) {
					$key = 'HTML5VideoQuality';
				}
				if ( $key == 'preloadselfhosted' ) {
					$key = 'preloadSelfHosted';
				}
				if ( $key == 'hidevideosource' ) {
					$key = 'hideVideoSource';
				}
				if ( $key == 'showallcontrols' ) {
					$key = 'showAllControls';
				}
				if ( $key == 'rightclickmenu' ) {
					$key = 'rightClickMenu';
				}
				if ( $key == 'ccshowonhtml5videos' ) {
					$key = 'ccShowOnHTML5Videos';
				}
				if ( $key == 'ccshowonvideoload' ) {
					$key = 'ccShowOnVideoLoad';
				}
				if ( $key == 'autohidecontrols' ) {
					$key = 'autohideControls';
				}
				if ( $key == 'hidecontrolsonmouseout' ) {
					$key = 'hideControlsOnMouseOut';
				}
				if ( $key == 'shuffle' ) {
					$key = 'shuffle';
				}
				if ( $key == 'playlistscrolltype' ) {
					$key = 'shuffle';
				}
				if ( $key == 'nowplayingtext' ) {
					$key = 'nowPlayingText';
				}
				if ( $key == 'rewindshow' ) {
					$key = 'rewindShow';
				}
				if ( $key == 'qualityshow' ) {
					$key = 'qualityShow';
				}
				if ( $key == 'infoshow' ) {
					$key = 'infoShow';
				}
				if ( $key == 'shareshow' ) {
					$key = 'shareShow';
				}
				if ( $key == 'facebookshow' ) {
					$key = 'facebookShow';
				}
				if ( $key == 'twittershow' ) {
					$key = 'twitterShow';
				}
				if ( $key == 'logoshow' ) {
					$key = 'logoShow';
				}
				if ( $key == 'logopath' ) {
					$key = 'logoPath';
				}
				if ( $key == 'logoposition' ) {
					$key = 'logoPosition';
				}
				if ( $key == 'logoclickable' ) {
					$key = 'logoClickable';
				}
				if ( $key == 'logogotolink' ) {
					$key = 'logoGoToLink';
				}
				if ( $key == 'allowskipad' ) {
					$key = 'allowSkipAd';
				}
				if ( $key == 'embedshow' ) {
					$key = 'embedShow';
				}
				if ( $key == 'showglobalprerollads' ) {
					$key = 'showGlobalPrerollAds';
				}
				if ( $key == 'globalprerollads' ) {
					$key = 'globalPrerollAds';
				}
				if ( $key == 'globalprerolladsskiptimer' ) {
					$key = 'globalPrerollAdsSkipTimer';
				}
				if ( $key == 'globalprerolladsgotolink' ) {
					$key = 'globalPrerollAdsGotoLink';
				}

				if ( $key == 'html5videos_sd' ) {
					$html5videos_sd = $atts['html5videos_sd'];
					$html5videos_sd = explode( ',', $html5videos_sd );
					foreach ( $html5videos_sd as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['mp4SD'] = $html5videos_sd[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_hd' ) {
					$html5videos_hd = $atts['html5videos_hd'];
					$html5videos_hd = explode( ',', $html5videos_hd );
					foreach ( $html5videos_hd as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['mp4HD'] = $html5videos_hd[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_title' ) {
					$html5videos_title = $atts['html5videos_title'];
					$html5videos_title = explode( ',', $html5videos_title );
					foreach ( $html5videos_title as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['title'] = $html5videos_title[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_description' ) {
					$html5videos_description = $atts['html5videos_description'];
					$html5videos_description = explode( ',', $html5videos_description );
					foreach ( $html5videos_description as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['description'] = $html5videos_description[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_thumb' ) {
					$html5videos_thumb = $atts['html5videos_thumb'];
					$html5videos_thumb = explode( ',', $html5videos_thumb );
					foreach ( $html5videos_thumb as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['thumbImg'] = $html5videos_thumb[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_info' ) {
					$html5videos_info = $atts['html5videos_info'];
					$html5videos_info = explode( ',', $html5videos_info );
					foreach ( $html5videos_info as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['info'] = $html5videos_info[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'html5videos_captions' ) {
					$html5videos_captions = $atts['html5videos_captions'];
					$html5videos_captions = explode( ',', $html5videos_captions );
					foreach ( $html5videos_captions as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['ccUrl'] = $html5videos_captions[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'prerolls' ) {
					$prerolls = $atts['prerolls'];
					$prerolls = explode( ',', $prerolls );
					foreach ( $prerolls as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['prerollAD']   = "yes";
						$elite_player['videos'][ $key2 ]['preroll_mp4'] = $prerolls[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'prerolls_skipseconds' ) {
					$prerolls_skipseconds = $atts['prerolls_skipseconds'];
					$prerolls_skipseconds = explode( ',', $prerolls_skipseconds );
					foreach ( $prerolls_skipseconds as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['prerollAD']        = "yes";
						$elite_player['videos'][ $key2 ]['prerollSkipTimer'] = $prerolls_skipseconds[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'prerolls_redirectonclick' ) {
					$prerolls_redirectonclick = $atts['prerolls_redirectonclick'];
					$prerolls_redirectonclick = explode( ',', $prerolls_redirectonclick );
					foreach ( $prerolls_redirectonclick as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['prerollAD']       = "yes";
						$elite_player['videos'][ $key2 ]['prerollGotoLink'] = $prerolls_redirectonclick[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'midrolls' ) {
					$midrolls = $atts['midrolls'];
					$midrolls = explode( ',', $midrolls );
					foreach ( $midrolls as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['midrollAD']   = "yes";
						$elite_player['videos'][ $key2 ]['midroll_mp4'] = $midrolls[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'midrolls_displaytime' ) {
					$midrolls_displaytime = $atts['midrolls_displaytime'];
					$midrolls_displaytime = explode( ',', $midrolls_displaytime );
					foreach ( $midrolls_displaytime as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['midrollAD']             = "yes";
						$elite_player['videos'][ $key2 ]['midrollAD_displayTime'] = $midrolls_displaytime[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'midrolls_skipseconds' ) {
					$midrolls_skipseconds = $atts['midrolls_skipseconds'];
					$midrolls_skipseconds = explode( ',', $midrolls_skipseconds );
					foreach ( $midrolls_skipseconds as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['midrollAD']        = "yes";
						$elite_player['videos'][ $key2 ]['midrollSkipTimer'] = $midrolls_skipseconds[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'midrolls_redirectonclick' ) {
					$midrolls_redirectonclick = $atts['midrolls_redirectonclick'];
					$midrolls_redirectonclick = explode( ',', $midrolls_redirectonclick );
					foreach ( $midrolls_redirectonclick as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['midrollAD']       = "yes";
						$elite_player['videos'][ $key2 ]['midrollGotoLink'] = $midrolls_redirectonclick[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'postrolls' ) {
					$postrolls = $atts['postrolls'];
					$postrolls = explode( ',', $postrolls );
					foreach ( $postrolls as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['postrollAD']   = "yes";
						$elite_player['videos'][ $key2 ]['postroll_mp4'] = $postrolls[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'postrolls_skipseconds' ) {
					$postrolls_skipseconds = $atts['postrolls_skipseconds'];
					$postrolls_skipseconds = explode( ',', $postrolls_skipseconds );
					foreach ( $postrolls_skipseconds as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['postrollAD']        = "yes";
						$elite_player['videos'][ $key2 ]['postrollSkipTimer'] = $postrolls_skipseconds[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'postrolls_redirectonclick' ) {
					$postrolls_redirectonclick = $atts['postrolls_redirectonclick'];
					$postrolls_redirectonclick = explode( ',', $postrolls_redirectonclick );
					foreach ( $postrolls_redirectonclick as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['postrollAD']       = "yes";
						$elite_player['videos'][ $key2 ]['postrollGotoLink'] = $postrolls_redirectonclick[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'popups' ) {
					$popups = $atts['popups'];
					$popups = explode( ',', $popups );
					foreach ( $popups as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['popupAdShow'] = "yes";
						$elite_player['videos'][ $key2 ]['popupImg']    = $popups[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'popups_displaytime' ) {
					$popups_displaytime = $atts['popups_displaytime'];
					$popups_displaytime = explode( ',', $popups_displaytime );
					foreach ( $popups_displaytime as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['popupAdShow']      = "yes";
						$elite_player['videos'][ $key2 ]['popupAdStartTime'] = $popups_displaytime[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'popups_hidetime' ) {
					$popups_hidetime = $atts['popups_hidetime'];
					$popups_hidetime = explode( ',', $popups_hidetime );
					foreach ( $popups_hidetime as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['popupAdShow']    = "yes";
						$elite_player['videos'][ $key2 ]['popupAdEndTime'] = $popups_hidetime[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'popups_redirectonclick' ) {
					$popups_redirectonclick = $atts['popups_redirectonclick'];
					$popups_redirectonclick = explode( ',', $popups_redirectonclick );
					foreach ( $popups_redirectonclick as $key2 => $val2 ) {
						$elite_player['videos'][ $key2 ]['popupAdShow']     = "yes";
						$elite_player['videos'][ $key2 ]['popupAdGoToLink'] = $popups_redirectonclick[ $key2 ];

						$elite_player['videoType']                    = 'HTML5';
						$elite_player['videos'][ $key2 ]['videoType'] = 'HTML5';
					}
				}

				if ( $key == 'youtubeplaylistid' ) {
					$apikey = $atts['youtubeapikey'];

					$youtubePlaylistID = $atts['youtubeplaylistid'];

					$json   = file_get_contents( 'https://www.googleapis.com/youtube/v3/playlistItems?&maxResults=50&part=snippet&playlistId=' . $youtubePlaylistID . '&key=' . $apikey . '&part=snippet' );
					$ytdata = json_decode( $json );

					for ( $x = 0; $x <= $ytdata->pageInfo->totalResults - 1; $x ++ ) {
						$elite_player['videos'][ $x ]['videoType']   = 'youtube';
						$elite_player['videos'][ $x ]['youtubeID']   = $ytdata->items[ $x ]->snippet->resourceId->videoId;
						$elite_player['videos'][ $x ]['title']       = $ytdata->items[ $x ]->snippet->title;
						$elite_player['videos'][ $x ]['description'] = $ytdata->items[ $x ]->snippet->channelTitle;
						$elite_player['videos'][ $x ]['info']        = $ytdata->items[ $x ]->snippet->description;
						$elite_player['videos'][ $x ]['thumbImg']    = $ytdata->items[ $x ]->snippet->thumbnails->default->url;
					}
				}

				if ( $key == 'youtubechannelid' ) {
					$apikey = $atts['youtubeapikey'];

					$youtubeChannelID = $atts['youtubechannelid'];

					$json   = file_get_contents( 'https://www.googleapis.com/youtube/v3/search?order=date&maxResults=50&part=snippet&channelId=' . $youtubeChannelID . '&key=' . $apikey . '&part=snippet' );
					$ytdata = json_decode( $json );

					for ( $x = 0; $x <= $ytdata->pageInfo->totalResults - 3; $x ++ ) {
						$elite_player['videos'][ $x ]['videoType']   = 'youtube';
						$elite_player['videos'][ $x ]['youtubeID']   = $ytdata->items[ $x ]->id->videoId;
						$elite_player['videos'][ $x ]['title']       = $ytdata->items[ $x ]->snippet->title;
						$elite_player['videos'][ $x ]['description'] = $ytdata->items[ $x ]->snippet->channelTitle;
						$elite_player['videos'][ $x ]['info']        = $ytdata->items[ $x ]->snippet->description;
						$elite_player['videos'][ $x ]['thumbImg']    = $ytdata->items[ $x ]->snippet->thumbnails->default->url;
					}
				}

				if ( $key == 'youtubevideos' ) {
					$apikey = $atts['youtubeapikey'];

					$youtubevideos = $atts['youtubevideos'];
					$youtubevideos = explode( ',', $youtubevideos );
					foreach ( $youtubevideos as $key2 => $val3 ) {
						$elite_player['videos'][ $key2 ]['youtubeID'] = $youtubevideos[ $key2 ];

						$elite_player['videoType']                    = 'youtube';
						$elite_player['videos'][ $key2 ]['videoType'] = 'youtube';

						$videoid = $youtubevideos[ $key2 ];

						$json                                           = file_get_contents( 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoid . '&key=' . $apikey . '&part=snippet' );
						$ytdata                                         = json_decode( $json );
						$elite_player['videos'][ $key2 ]['title']       = $ytdata->items[0]->snippet->title;
						$elite_player['videos'][ $key2 ]['description'] = $ytdata->items[0]->snippet->channelTitle;
						$elite_player['videos'][ $key2 ]['info']        = $ytdata->items[0]->snippet->description;
						$elite_player['videos'][ $key2 ]['thumbImg']    = $ytdata->items[0]->snippet->thumbnails->default->url;
					}
				}

				if ( $key == 'vimeovideos' ) {
					$vimeovideos            = $atts['vimeovideos'];
					$vimeovideos            = explode( ',', $vimeovideos );
					$elite_player['videos'] = Array();
					foreach ( $vimeovideos as $key2 => $val4 ) {
						$elite_player['videos'][ $key2 ]['vimeoID'] = $vimeovideos[ $key2 ];

						$imgid = $vimeovideos[ $key2 ];

						$hash                                           = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$imgid.php" ) );
						$elite_player['videos'][ $key2 ]['title']       = $hash[0]['title'];
						$elite_player['videos'][ $key2 ]['description'] = $hash[0]['user_name'];
						$elite_player['videos'][ $key2 ]['thumbImg']    = $hash[0]['thumbnail_small'];


						$elite_player['videoType']                    = 'vimeo';
						$elite_player['videos'][ $key2 ]['videoType'] = 'vimeo';
					}
				}

				$elite_player[ $key ] = $val;
			}

		}

		$elite_player = $this->read_sources( $elite_player );

		$output = ( '<div class="Elite_video_player" id="' . $elite_id . '" ><div id="elite_options" style="display:none;">' . json_encode( $elite_player ) . '</div></div>' );

		return $output;
	}

	/**
	 * Rewrite videos from post source
	 *
	 * @since 1.0.0
	 *
	 * @param $elite_player
	 *
	 * @return array
	 */
	private function read_sources( $elite_player ) {
		global $post;

		$source_type = false;

		for ( $i = 1; $i <= 100; $i ++ ) {
			$source      = get_field( 'elite-video-source-' . $i, $post->ID );
			$source_type = Elite_Video_Player_Sources_Checks::check_source( $source );
			if ( false !== $source_type ) {
				break;
			} else {
				update_field( 'elite-video-source-' . $i, $post->ID, '' );
			}
		}

		if ( false !== $source_type ) {
			$embed_source = Elite_Video_Player_Sources_Checks::get_embed_source( $source, $source_type );

			$first_video          = isset( $elite_player['videos'][0] ) ? $elite_player['videos'][0] : array();
			$first_video['title'] = $post->post_title;

			if ( 'youtube' == $source_type ) {
				$elite_player['videoType'] = 'youtube';
				$first_video['videoType']  = 'youtube';
				$first_video['youtubeID']  = Elite_Video_Player_Sources_Checks::get_youtube_id( $embed_source );
				unset( $first_video['mp4HD'] );
				unset( $first_video['mp4SD'] );
			} else {
				$elite_player['videoType'] = 'HTML5';
				$first_video['videoType']  = 'HTML5';
				$first_video['mp4HD']      = $embed_source;
				$first_video['mp4SD']      = $embed_source;
				unset( $first_video['youtubeID'] );
			}

			$elite_player['videos'] = array(
				$first_video
			);


		}

		return $elite_player;
	}
}

$player = new Elite_Video_Player_Sources_Player;
$player->init();