-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2015 at 09:12 AM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tracker_list`
--

CREATE TABLE IF NOT EXISTS `tracker_list` (
`id` int(11) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `url` varchar(2081) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracker_list`
--

INSERT INTO `tracker_list` (`id`, `domain`, `url`, `type`) VALUES
(1, 'AddThis', 's7.addthis.com/js/300/addthis_widget.js', 'script'),
(2, 'AddToAny', 'static.addtoany.com/menu/page.js', 'script'),
(3, 'Adroll', 'a.adroll.com/j/roundtrip.js', 'script'),
(4, 'Adzerk', 'static.smoothx.com/ados.js', 'script'),
(5, 'Adzerk', 'static.adzerk.net/ados.js', 'script'),
(6, 'BuySellAds', 's3.buysellads.com/ac/bsa.js', 'script'),
(7, 'Comscore Beacon', 'b.scorecardresearch.com/beacon.js', 'script'),
(8, 'Doubleclick', 'stats.g.doubleclick.net/dc.js', 'script'),
(9, 'Facebook Connect', 'connect.facebook.net/en_US/all.js', 'script'),
(10, 'Facebook Connect', 'static.ak.fbcdn.net/connect.php/js/FB.Share', 'script'),
(11, 'Google Analytics (Standard)', 'google-analytics.com/analytics.js', 'script'),
(12, 'Google Ad', 'pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', 'script'),
(13, 'Google Analytics (Classic)', 'google-analytics.com/ga.js', 'script'),
(14, 'Google Analytics (Urchin)', 'google-analytics.com/urchin.js', 'script'),
(15, 'Google Analytics (Classic)', 'ssl.google-analytics.com/ga.js"', 'script'),
(16, 'Gravatar', 'gravatar.com/js/gprofiles.js', 'script'),
(17, 'Marketo', 'ssl-munchkin.marketo.net/js/munchkin.js', 'script'),
(18, 'Marketo', 'munchkin.marketo.net/munchkin.js', 'script'),
(19, 'Mixpanel', 'cdn.mxpnl.com/libs/mixpanel-2.2.min.js', 'script'),
(20, 'New Relic', 'js-agent.newrelic.com/nr-476.min.js', 'script'),
(21, 'Parse.ly', 'static.parsely.com/p.js', 'script'),
(22, 'Woopra', 'static.woopra.com/js/woopra.js', 'script'),
(23, 'Woopra', 'static.woopra.com/js/w.js', 'script'),
(24, 'Wordpress Stats', 'stats.wordpress.com/e-201502.js', 'script'),
(25, 'Linkedin', 'platform.linkedin.com/in.js', 'script'),
(26, 'Google+1', 'apis.google.com/js/plusone.js', 'script'),
(27, 'Google Adwords', 'googleadservices.com/pagead/conversion.js', 'script'),
(28, 'Kiss Metrics', 'i.kissmetrics.com/i.js', 'script'),
(29, 'Twitter Bedge', 'platform.twitter.com/widgets.js', 'script'),
(30, 'ChartBeat', 'static.chartbeat.com/js/chartbeat.js', 'script'),
(31, 'Google Adsense', 'pagead2.googlesyndication.com/pagead/show_ads.js', 'script'),
(32, 'Share This', 'w.sharethis.com/button/sharethis.js', 'script'),
(33, 'Visual Website Optimizer', 'dev.visualwebsiteoptimizer.com/j.php', 'script'),
(34, 'Adroll', 's.adroll.com/j/roundtrip.js', 'script'),
(35, 'Clicky', 'static.getclicky.com/js', 'script'),
(36, 'Hellobar', 'hellobar.com/hellobar.js', 'script'),
(37, 'Hellobar', 'old.hellobar.com/hellobar.js', 'script'),
(38, 'OutBrain', 'widgets.outbrain.com/OutbrainRater.js', 'script'),
(39, 'Tynt Tracer', 'cdn.tynt.com/tc.js', 'script'),
(40, 'Infolinks', 'resources.infolinks.com/js/infolinks_main.js', 'script'),
(41, 'Kontera ContentLink', 'kona.kontera.com/javascript/lib/KonaLibInline.js', 'script'),
(42, 'Gigya', 'cdn.gigya.com/JS/socialize.js', 'script'),
(43, 'Lead Lander', 't3.trackalyzer.com/trackalyze.js', 'script'),
(44, 'Statcounter', 'statcounter.com/counter/counter.js', 'script'),
(45, 'Mixpanel', 'cdn.mxpnl.com/libs/mixpanel-2-latest.min.js', 'script'),
(46, 'Shopsocially', 'shopsocially.com/js/all.js', 'script'),
(47, 'BlueKai', 'bkrtx.com/js/bk-static.js', 'script'),
(48, 'ShareThis', 'w.sharethis.com/button/buttons.js', 'script'),
(49, 'Hurra', 'hurra.com/owatag.js', 'script'),
(50, 'LeadLander', 'trackalyzer.com/trackalyze.js', 'script'),
(51, 'LeadLander', 'trackalyzer.com/trackalyze_secure.js', 'script'),
(52, 'Visitorpath', 'track.visitorpath.com/js/track.js', 'script'),
(53, 'Netratings Site Census"', 'secure-us.imrworldwide.com/v53.js', 'script'),
(54, 'ScoreCard Research Beacon', 'scorecardresearch.com/beacon.js', 'script'),
(55, 'Coremetrics', 'libs.coremetrics.com/eluminate.js', 'script'),
(56, 'Visistat', 'stats.visistat.com/live.js', 'script'),
(57, 'Google Tag Manager', 'googletagmanager.com/gtm.js', 'script'),
(58, 'Google Conversion Tracker', 'googleadservices.com/pagead/conversion.js', 'script'),
(59, 'Google Tag Service', 'googletagservices.com/tag/js/gpt.js', 'script'),
(60, 'OutBrain - Visual Revenue', 'visualrevenue.com/vrs.js', 'script'),
(61, 'Pingdom', 'rum-static.pingdom.net/prum.min.js', 'script'),
(62, 'Optimizely', 'cdn.optimizely.com/js/', ''),
(63, 'Share This', 'sharethis.com/button/sharethis.js', ''),
(64, 'Comscore Beacon', 'beacon.js', 'script'),
(65, 'Clicktale', 'cdn.clicktale.net/www', ''),
(66, 'Facebook Connect', 'connect.facebook.net', ''),
(67, 'Disqus', 'disqus.com/embed.js', 'script'),
(68, 'Disqus', 'disqus.com/count.js', 'script'),
(69, 'Disqus', 'disquscdn.com/count.js', 'script'),
(70, 'Disqus', 'disquscdn.com/embed.js', 'script'),
(71, 'Quantcast', 'quantserve.com/quant.js', 'script'),
(72, 'Hellobar', 'hellobar.com/hellobar', ''),
(73, 'Hellobar', 'old.hellobar.com/hellobar', ''),
(74, 'Yahoo Web Analytics', 'analytics.yahoo.com/fpc.pl', ''),
(75, 'Blog Ads', 'blogads.com', ''),
(76, 'CrazyEgg', 'dnn506yrbagrg.cloudfront.net/pages/scripts/', ''),
(77, 'Typekit', 'use.typekit.net/', ''),
(78, 'AdNexus', 'ib.adnxs.com/', ''),
(79, 'PO.ST', 'po.st/static/v3/post-widget.js', 'script'),
(80, 'AddThis', 'addthis_widget.js', ''),
(81, 'Foresee Results', 'foresee/foresee-trigger.js', 'script'),
(82, 'Demandbase', 'api.demandbase.com/api/v2/', ''),
(83, 'Piwik', 'piwik.js', ''),
(84, 'Webtrends', 'webtrends.com/js/webtrends', ''),
(85, 'Zedo', 'zedo.com/jsc/fm.js', 'script'),
(86, 'Krux Digital', 'krxd.net/ctjs/controltag.js', 'script'),
(87, 'Omniture', 'www.idge/js/analytics/s_code.js', 'script'),
(88, 'Brightcove', 'brightcove.com/js/BrightcoveExperiences.js', 'script'),
(89, 'Eloqua', 'topliners.eloqua.com', ''),
(90, 'Maxymizer', 'js/mmcore.js', 'script'),
(91, 'Onestat', 'onestat.com/asp', ''),
(92, 'BlueKai', 'bkrtx.com/js/bk', ''),
(93, 'LeadLander', 'trackalyzer.com/trackalyze.js', 'script'),
(94, 'LeadLander', 'trackalyzer.com/trackalyze_secure.js', 'script'),
(95, 'HubSpot Analytics', 'js.hs-analytics.net/analytics/', ''),
(96, 'Pardot', 'pardot.com/pd.js', 'script'),
(97, 'Gravatar', 'gravatar.com/js/gprofiles.js', 'script'),
(98, 'Meteor', 'cdnt.meteorsolutions.com/api/track', ''),
(99, 'Livechat Inc', 'livechatinc.com/tracking.js', 'script'),
(100, 'Databrain', 'databrain.com/track.ashx', ''),
(101, 'ChartBeat', 'chartbeat.js', 'script'),
(102, 'Mouseflow', 'cdn.mouseflow.com/projects/', ''),
(103, 'Omniture', 'omniture', ''),
(104, 'Seevolution', 'svlu.net/cjs.aspx', ''),
(105, 'Seevolution', 'seevolution.com/cjs.aspx', ''),
(106, 'Unknown Tracker', 'analytics', 'other'),
(107, 'OutBrain', 'outbrain.com/outbrain.js', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracker_list`
--
ALTER TABLE `tracker_list`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracker_list`
--
ALTER TABLE `tracker_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
