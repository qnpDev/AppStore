-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2021 lúc 10:26 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qnp`
--
CREATE DATABASE IF NOT EXISTS `qnp` DEFAULT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci;
USE `qnp`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app`
--

CREATE TABLE `app` (
  `id` int(11) NOT NULL,
  `devid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `file` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `ver` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '1.0.0',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateupdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `mota` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `icon` text COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `app`
--

INSERT INTO `app` (`id`, `devid`, `name`, `type`, `status`, `file`, `price`, `ver`, `date`, `dateupdate`, `mota`, `size`, `icon`) VALUES
(1, 1, 'TikTok', 'music', 2, 'tiktok.txt', 50000, '1.0.0', '2021-04-16 17:00:00', '2021-05-14 04:14:01', 'TikTok is THE destination for mobile videos. On TikTok, short-form videos are exciting, spontaneous, and genuine. Whether you’re a sports fanatic, a pet enthusiast, or just looking for a laugh, there’s something for everyone on TikTok. All you have to do is watch, engage with what you like, skip what you don’t, and you’ll find an endless stream of short videos that feel personalized just for you. From your morning coffee to your afternoon errands, TikTok has the videos that are guaranteed to make your day.\r\nWe make it easy for you to discover and create your own original videos by providing easy-to-use tools to view and capture your daily moments. Take your videos to the next level with special effects, filters, music, and more.\r\n■ Watch endless amount of videos customized specifically for you\r\nA personalized video feed based on what you watch, like, and share. TikTok offers you real, interesting, and fun videos that will make your day.\r\n■ Explore videos, just one scroll away\r\nWatch all types of videos, from Comedy, Gaming, DIY, Food, Sports, Memes, and Pets, to Oddly Satisfying, ASMR, and everything in between.\r\n■ Pause recording multiple times in one video\r\nPause and resume your video with just a tap. Shoot as many times as you need.\r\n■ Be entertained and inspired by a global community of creators\r\nMillions of creators are on TikTok showcasing their incredible skills and everyday life. Let yourself be inspired.\r\n■ Add your favorite music or sound to your videos for free\r\nEasily edit your videos with millions of free music clips and sounds. We curate music and sound playlists for you with the hottest tracks in every genre, including Hip Hop, Edm, Pop, Rock, Rap, and Country, and the most viral original sounds.\r\n■ Express yourself with creative effects\r\nUnlock tons of filters, effects, and AR objects to take your videos to the next level.\r\n■ Edit your own videos\r\nOur integrated editing tools allow you to easily trim, cut, merge and duplicate video clips without leaving the app.\r\n* Any feedback? Contact us at https://www.tiktok.com/legal/report/feedback or tweet us @tiktok_us', 0, 'tiktok.png'),
(2, 1, 'Facebook', 'utilities', 3, 'facebook.txt', 1, '1.0.0', '2021-04-16 17:00:00', '2021-04-22 09:22:43', NULL, 0, 'facebook.png'),
(3, 1, 'Youtube', 'comunicate', 2, NULL, 2, '1.0.0', '2021-05-12 17:00:00', '2021-04-22 09:22:43', NULL, 0, NULL),
(4, 1, 'Instagram', 'comunicate', 3, NULL, 0, '1.0.0', '2021-04-16 17:00:00', '2021-04-22 09:22:43', NULL, 0, NULL),
(5, 4, 'Messenger', 'utilities', 3, NULL, 0, '1.0.0', '2021-04-16 17:00:00', '2021-04-22 09:22:43', NULL, 0, NULL),
(6, 1, 'Maps', 'utilities', 3, NULL, 0, '1.0.0', '2021-04-16 17:00:00', '2021-04-22 09:22:43', NULL, 0, NULL),
(14, 1, 'test Remove', 'comunicate', 0, '', 10, '1.0.0', '2021-05-13 06:59:55', '2021-05-13 06:59:55', 'ghghhg', 0, ''),
(19, 5, 'Instagram', 'comunicate', 2, 'Instagram.zip', 0, '187.0', '2021-05-15 11:00:44', '2021-05-15 22:46:26', 'Bringing you closer to the people and things you love. — Instagram from Facebook\r\n\r\nConnect with friends, share what you’re up to, or see what\'s new from others all over the world. Explore our community where you can feel free to be yourself and share everything from your daily moments to life\'s highlights.\r\n\r\nExpress Yourself and Connect With Friends\r\n\r\n* Add photos and videos to your INSTA story that disappear after 24 hours, and bring them to life with fun creative tools.\r\n* Message your friends in Direct. Start fun conversations about what you see on Feed and Stories.\r\n* Post photos and videos to your feed that you want to show on your profile.\r\n\r\nLearn More About Your Interests\r\n\r\n* Check out IGTV for longer videos from your favorite INSTA creators.\r\n* Get inspired by photos and videos from new INSTA accounts in Explore.\r\n* Discover brands and small businesses, and shop products that are relevant to your personal style.', 374, 'iconInstagram.png'),
(20, 5, 'Messenger', 'utilities', 2, 'Messenger.zip', 0, '311.0', '2021-05-15 11:06:23', '2021-05-16 02:43:39', 'Be together whenever, with our free* all-in-one communication app, complete with unlimited text, voice, video calling and group video chat features. Easily sync your messages and contacts to your Android phone and connect with anyone, anywhere.\r\n\r\nCROSS-APP MESSAGING AND CALLING\r\nConnect with your Instagram friends right from Messenger. Simply search for them by name or username to message or call.\r\n\r\nVANISH MODE\r\nSend messages that only last for a moment. Opt in to use vanish mode where seen messages disappear after you exit the chat.\r\n\r\nPRIVACY SETTINGS\r\nNew privacy settings let you choose who can reach you, and where your messages are delivered.\r\n\r\nCUSTOM REACTIONS\r\nLost for words? You can customize your reactions, with lots more emojis to choose from, including ', 0, 'iconMessenger.png'),
(21, 5, 'Twitter', 'comunicate', 0, '', 50, '8.65', '2021-05-15 11:12:12', '2021-05-16 02:44:05', 'Join the conversation!\r\n\r\nRetweet, chime in on a thread, go viral, or just scroll through the Twitter timeline to stay on top of what everyone’s talking about. Twitter is your go-to social media app and the new media source for what\'s happening in the world, straight from the accounts of the influential people who affect your world day-to-day.\r\n\r\nExplore what’s trending in the media, or get to know thought-leaders in the topics that matter to you; whether your interests range from #Kpop Twitter to politics, news or sports, you can follow & speak directly to influencers or your friends alike. Every voice can impact the world.\r\n\r\nFollow your interests. ⭐ Tweet, Fleet, Retweet, Reply to Tweets, Share or Like - Twitter is the #1 social media app for latest news & updates.\r\n\r\nTap into what’s going on around you. Search hashtags and trending topics to stay updated on your friends & other Twitter followers. Follow the tweets of your favorite influencers, alongside hundreds of interesting Twitter users, and read their content at a glance.\r\n\r\nShare your opinion. Engage your social network with noteworthy links, photos and videos. DM your friends or reply in a thread. Whether you chat privately or go viral, your voice makes a difference.\r\n\r\nGet noticed. Twitter allows you to find interesting people or build a following of people who are interested in you. Maintaining a social connection has never been easier! Beyond chatting with friends, Twitter allows influencers to build a personal connection with their fans. Speak directly to the people who influence you - you may be surprised by how many answer back.\r\n\r\n✔️ Build your profile:\r\n*Customize your profile, add a photo, description, location, and background photo\r\n*Tweet often and optimize your posting times ', 0, 'iconTwitter.png'),
(17, 5, 'Facebook', 'utilities', 2, '1621068815-Facebook.zip', 20000, '318.0', '2021-05-15 08:53:48', '2021-05-16 02:42:57', 'Keeping up with friends is faster and easier than ever. Share updates and photos, engage with friends and Pages, and stay connected to communities important to you.\r\n\r\nFeatures on the Facebook app include:\r\n\r\n* Connect with friends and family and meet new people on your social media network\r\n* Set status updates & use Facebook emoji to help relay what’s going on in your world\r\n* Share photos, videos, and your favorite memories.\r\n* Get notifications when friends like and comment on your posts\r\n* Find local social events, and make plans to meet up with friends\r\n* Play games with any of your Facebook friends\r\n* Backup photos by saving them in albums\r\n* Follow your favorite artists, websites, and companies to get their latest news\r\n* Look up local businesses to see reviews, operation hours, and pictures\r\n* Buy and sell locally on Facebook Marketplace\r\n* Watch live videos on the go\r\n\r\n\r\nThe Facebook app does more than help you stay connected with your friends and interests. It\'s also your personal organizer for storing, saving and sharing photos. It\'s easy to share photos straight from your Android camera, and you have full control over your photos and privacy settings. You can choose when to keep individual photos private or even set up a secret photo album to control who sees it.\r\n\r\nFacebook also helps you keep up with the latest news and current events around the world. Subscribe to your favorite celebrities, brands, news sources, artists, or sports teams to follow their newsfeeds, watch live streaming videos and be caught up on the latest happenings no matter where you are!\r\n\r\nThe most important desktop features of Facebook are also available on the app, such as writing on timelines, liking photos, browsing for people, and editing your profile and groups.\r\n\r\nNow you can get early access to the next version of Facebook for Android by becoming a beta tester. Learn how to sign up, give feedback and leave the program in our Help Center: http://on.fb.me/133NwuP\r\n\r\nSign up directly here:\r\nhttp://play.google.com/apps/testing/com.facebook.katana\r\n\r\nProblems downloading or installing the app? See http://bit.ly/GPDownload1\r\nStill need help? Please tell us more about the issue. http://bit.ly/invalidpackage\r\n\r\nFacebook is only available for users age 13 and over.\r\nTerms of Service: http://m.facebook.com/terms.php.', 0, '1621068815-iconFB.png'),
(18, 5, 'Youtube', 'comunicate', 2, 'Youtube.zip', 0, '16.18.5', '2021-05-15 09:11:11', '2021-05-15 09:11:11', 'Get the official YouTube app on Android phones and tablets. See what the world is watching -- from the hottest music videos to what’s popular in gaming, fashion, beauty, news, learning and more. Subscribe to channels you love, create content of your own, share with friends, and watch on any device.\r\n\r\nWatch and subscribe\r\n● Browse personal recommendations on Home\r\n● See the latest from your favorite channels in Subscriptions\r\n● Look up videos you’ve watched, liked, and saved for later in Library\r\n\r\nExplore different topics, what’s popular, and on the rise (available in select countries)\r\n● Stay up to date on what’s popular in music, gaming, beauty, news, learning and more\r\n● See what’s trending on YouTube and around the world on Explore\r\n● Learn about the coolest Creators, Gamers, and Artists on the Rise (available in select countries)\r\n\r\nConnect with the YouTube community\r\n● Keep up with your favorites creators with Posts, Stories, Premieres, and Live streams\r\n● Join the conversation with comments and interact with creators and other community members\r\n\r\nCreate content from your mobile device\r\n● Create or upload your own videos directly in the app\r\n● Engage with your audience in real time with live streaming right from the app\r\n\r\nFind the experience that fits you and your family (available in select countries)\r\n● Every family has their own approach to online video. Learn about your options: the YouTube Kids app or a new parent supervised experience on YouTube at youtube.com/myfamily\r\n\r\nSupport creators you love with channel memberships (available in select countries)\r\n● Join channels that offer paid monthly memberships and support their work\r\n● Get access to exclusive perks from the channel & become part of their members community\r\n● Stand out in comments and live chats with a loyalty badge next to your username\r\n\r\nUpgrade to YouTube Premium (available in select countries)\r\n● Watch videos uninterrupted by ads, while using other apps, or when the screen is locked\r\n● Save videos for when you really need them – like when you’re on a plane or commuting\r\n● Get access to YouTube Music Premium as part of your benefits', 368, 'iconYoutube.png'),
(22, 5, 'Zalo', 'utilities', 2, 'Zalo.zip', 0, '21.04.01', '2021-05-15 11:16:11', '2021-05-15 11:16:11', 'Zalo is the new market-leading messaging app with amazing features.\r\n\r\n* Rich feature set:\r\n=> Message your friend in a snap. Receive notifications the moment they reply back.\r\n=> Express your emotion with fun and cheerful emoticons and stickers.\r\n=> Send voice messages with fantastic quality and no outside noises\r\n=> Find and get acquainted with friends nearby\r\n=> Send group messages easily with no effort\r\n=> Integration with social networks like Facebook and Google+\r\n=> High level of privacy\r\n\r\nDownload Zalo and chat with your friends!\r\n\r\nSupport Information:\r\n- Online: http://zalo.me/zalohotroandroid\r\n- Email: feedback@zaloapp.com\r\n- Website: http://zalo.me', 447, 'iconZalo.png'),
(23, 5, 'Gmail', 'utilities', 2, 'Gmail.zip', 0, '6.0.210404', '2021-05-15 11:55:02', '2021-05-15 11:55:02', 'Gmail is an easy to use email app that saves you time and keeps your messages safe. Get your messages instantly via push notifications, read and respond online & offline, and find any message quickly.\r\nWith the Gmail app you get:\r\n• An organized inbox - Social and promotional messages are sorted into categories so you can read messages from friends and family first.\r\n• Less spam - Gmail blocks spam before it hits your inbox to keep your account safe and clutter free.\r\n• 15GB of free storage - You won’t need to delete messages to save space.\r\n• Multiple account support - Use both Gmail and non-Gmail addresses (Outlook.com, Yahoo Mail, or any other IMAP/POP email) right from the app.', 565, 'iconGmail.png'),
(24, 5, 'Zoom', 'utilities', 2, 'Zoom.zip', 0, '5.6.4', '2021-05-15 12:01:06', '2021-05-15 12:01:06', 'Stay connected wherever you go – start or join a secure meeting with flawless video and audio, instant screen sharing, and cross-platform instant messaging - for free!\r\n\r\nZoom is #1 in customer satisfaction and the best unified communication experience on mobile.\r\n\r\nIt\'s super easy! Install the free Zoom app, click on \"New Meeting,\" and invite up to 100 people to join you on video! Connect with anyone on Android based phones and tablets, other mobile devices, Windows, Mac, Zoom Rooms, H.323/SIP room systems, and telephones.\r\n\r\nVIDEO MEETINGS FROM ANYWHERE\r\n-Best video meeting quality\r\n-Easily join a meeting or start an instant meeting with phone, email, or company contacts\r\n\r\nCOLLABORATE ON-THE-GO\r\n-Best Android device content and mobile screen sharing quality\r\n-Co-annotate over shared content\r\n-Real-time whiteboard collaboration on Android tablets\r\n\r\nUNLIMITED MESSAGING (WITH PHOTOS, FILES, AND MORE)\r\n-Reach people instantly to easily send messages, files, images, links, and gifs\r\n-Quickly respond or react to threaded conversations with emojis\r\n-Create or join public and private chat channels\r\n\r\nMAKE, RECEIVE, AND MANAGE PHONE CALLS\r\n-Effortlessly make or receive calls with your business number\r\n-Get voicemail and call recording with transcripts\r\n-Use call delegation to make/receive calls on behalf of others\r\n-Setup auto-receptionists to autonomously answer and route calls\r\n\r\nAND MORE….\r\n-Safe driving mode while on the road\r\n-Use your Android app to start your meeting or for direct share in Zoom Rooms\r\n-Join Zoom Webinars\r\n-Attend OnZoom events (US Beta only)\r\n-Works over WiFi, 5G, 4G/LTE, and 3G networks\r\n\r\nZOOM LICENSE INFORMATION:\r\n-Any free or paid license can be used with the app\r\n-Zoom Phone is an add-on to paid Zoom licenses\r\n-A paid Zoom subscription is required for certain product features\r\n\r\nFollow us on social @zoom!\r\n\r\nHave a question? Contact us at http://support.zoom.us.', 662, 'iconZoom.png'),
(25, 5, 'Google Meet', 'utilities', 2, 'GoogleMeet.zip', 0, '62.0.0', '2021-05-15 12:06:04', '2021-05-15 12:06:04', 'Securely connect, collaborate, and celebrate from anywhere. With Google Meet, everyone can safely create and join high-quality video meetings for groups of up to 250 people.\r\n\r\n• Meet safely - video meetings are encrypted in transit and our array of safety measures are continuously updated for added protection\r\n• Host large meetings - invite up to 250 participants to a meeting, whether they’re in the same team or outside of your organization\r\n• Easy access on any device - share a link and invite team members to join your conversations with one click from a web browser or the Google Meet mobile app\r\n• Share your screen - present documents, slides, and more during your conference call.\r\n• Participate in broadcasted events - teams, businesses, and schools can view and present in live-streamed events that include up to 100,000 in-domain viewers\r\n• Record for later - for important events on your calendar, hit record while in the meeting and get the recording file straight from Google Drive\r\n• Follow along - live, real-time captions powered by Google speech-to-text technology\r\n\r\nFollow us for more:\r\nTwitter: https://twitter.com/gsuite\r\nLinkedin: https://www.linkedin.com/showcase/gsuite\r\nFacebook: https://www.facebook.com/gsuitebygoogle/', 836, 'iconGoogleMeet.png'),
(26, 5, 'BAEMIN', 'food&drink', 2, 'BEAMIN.zip', 20000, '0.79.14', '2021-05-15 12:22:54', '2021-05-15 12:22:54', 'We\'re very passionate about delivering food. Have you tried?\r\n\r\n# Super-easy to find the food you like\r\nSearch the tasting food or the restaurant on our app in just 1 click\r\n\r\n# Crazy discounts\r\nEnjoy our countless vouchers & promotions.\r\n\r\n# Feature food for your mood\r\nCheck it out! What’s your mood today?\r\n\r\n# New Collection “District Specialty”\r\n“District Specialty” which offers a list of recommended restaurant organised by district. Collection includes 10 districts with 300 must-try restaurants for each one. Enjoy authentic Vietnamese local food with 60% discount and more.\r\n\r\nLet’s download BAEMIN now.', 535, 'iconBeamin.png'),
(27, 5, 'Foody', 'food&drink', 2, 'Foody.zip', 0, '5.7.2', '2021-05-15 12:28:34', '2021-05-15 12:28:34', 'The application to \"search\" and \"review\" food locations in most of the provinces and cities in Vietnam such as Ho Chi Minh City, Hanoi, Da Nang, Hai Phong, Nha Trang....\r\n\r\nWith the clear classification in Restaurant, Cafe / Ice cream, Bakery, Bar / pub & Karaoke. Foody has thousands locations, Reviews, Photos, which helps you easily find where to enjoy.\r\n\r\nMain Features:\r\n\r\nFIND WHERE TO EAT\r\nInput your keywords for the purpose of eating, place name, category, area to search.\r\n\r\nSHARE & REVIEWS\r\nEasy to write a review, upload photos and share to community\r\n\r\nPHOTOSHOOT & SHARE\r\nA tool is just like Instagram, you can Crop photo, rotate, multiple select photo ...\r\n\r\nADD/SUGGEST NEW PLACE\r\nYou can add a new place to Foody\r\n\r\nSend Feedback to us at: mobileapp@foody.vn', 645, 'iconFoody.png'),
(28, 5, 'Netflix', 'entertainment', 2, 'Netflix.zip', 50000, '13.27.0', '2021-05-15 12:32:40', '2021-05-15 12:32:40', 'Looking for the most talked about TV shows and movies from the around the world? They’re all on Netflix.\r\n\r\nWe’ve got award-winning series, movies, documentaries, and stand-up specials. And with the mobile app, you get Netflix while you travel, commute, or just take a break.\r\n\r\nWhat you’ll love about Netflix:\r\n\r\n• We add TV shows and movies all the time. Browse new titles or search for your favorites, and stream videos right on your device.\r\n• The more you watch, the better Netflix gets at recommending TV shows and movies you’ll love.\r\n• Create up to five profiles for an account. Profiles give different members of your household their own personalized Netflix.\r\n• Enjoy a safe watching experience just for kids with family-friendly entertainment.\r\n• Preview quick videos of our series and movies and get notifications for new episodes and releases.\r\n• Save your data. Download titles to your mobile device and watch offline, wherever you are.\r\n\r\nFor complete terms and conditions, please visit http://www.netflix.com/termsofuse\r\nFor privacy statement, please visit http://www.netflix.com/privacy\r\n', 356, 'iconNetflix.png'),
(29, 5, 'Youtube Kids', 'kids', 2, 'YoutubeKids.zip', 0, '6.14.1', '2021-05-15 12:37:46', '2021-05-15 12:37:46', 'A video app made just for kids\r\nYouTube Kids was created to give kids a more contained environment that makes it simpler and more fun for them to explore on their own, and easier for parents and caregivers to guide their journey as they discover new and exciting interests along the way. Learn more at youtube.com/kids\r\n\r\nA safer online experience for kids\r\nWe work hard to keep the videos on YouTube Kids family-friendly and use a mix of automated filters built by our engineering teams, human review, and feedback from parents to protect our youngest users online. But no system is perfect and inappropriate videos can slip through, so we’re constantly working to improve our safeguards and offer more features to help parents create the right experience for their families.\r\n\r\nCustomize your child’s experience with Parental Controls\r\nLimit screen time: Set a time limit for how long your kids can watch and help encourage their transition from watching to doing.\r\nKeep up with what they watch: Simply check the watch it again page and you’ll always know what they’ve watched and the newest interests they’re exploring.\r\nBlocking: Don’t like a video? Block the video or whole channel, and never see it again.\r\nFlagging: You can always alert us to inappropriate content by flagging a video for review. Flagged videos are reviewed 24 hours a day, seven days a week.\r\n\r\nCreate individual experiences as unique as your kids\r\nCreate up to eight kid profiles, each with their own viewing preferences, video recommendations, and settings. Choose from \"Approved Content Only\" mode or select an age category that fits your child, \"Preschool\", \"Younger\", or \"Older\".\r\n\r\nSelect the \"Approved Content Only\" mode if you want to handpick the videos, channels and/or collections that you’ve approved your child to watch. In this mode, kids won’t be able to search for videos.The \"Preschool\" Mode designed for kids 4 and under curates videos that promote creativity, playfulness, learning, and exploration. The \"Younger\" Mode allows kids 5-7 to explore their interests in a wide variety of topics including songs, cartoons, and crafts. While our \"Older\" Mode gives kids 8 and up the chance to search and explore additional content such as popular music and gaming videos for kids.\r\n\r\nAll kinds of videos for all kinds of kids\r\nOur library is filled with family-friendly videos on all different topics, igniting your kids’ inner creativity and playfulness. It’s everything from their favorite shows and music to learning how to build a model volcano (or make slime ;-), and everything in between.\r\n\r\nOther important information:\r\nParental setup is needed to ensure the best experience possible for your kid.\r\nYouTube Kids contains paid ads in order to offer the app for free. Your kid may also see videos with commercial content from YouTube creators that are not paid ads.The Privacy Notice for Google Accounts managed with Family Link describes our privacy practices when your kid uses YouTube Kids with their Google Account. When your kid uses YouTube Kids without signing into their Google Account, the YouTube Kids Privacy Notice applies.', 310, 'iconYoutubeKids.png'),
(30, 5, 'Bluezone', 'health', 2, 'Bluezone.zip', 0, '3.3.8', '2021-05-15 12:41:59', '2021-05-15 12:41:59', 'The Bluezone app, of which the development is presided over by Viet Nam’s Ministry of Information and Communications and Ministry of Health.\r\n\r\nBluezone is applicable to people who are living and traveling in Vietnam.\r\n\r\nThe app is to protect the community against COVID-19 pandemic, helping bring the life back to normal. Viet Nam’s Ministry of Information and Communications and Ministry of Health, under the direction by the Prime Minister, have deployed the app called “Bluezone - Contact detection” to smartphones.\r\n\r\nBluezone shall alert if you had close contact with people who have COVID-19, thereby minimizing the spread of the virus to the community, helping people return to their normal life. When there is a new case of infection, you can learn whether you had close contact with this case or not simply by accessing Bluezone.\r\n\r\nThe more people install Bluezone, there more effective it is. Let’s challenge the virus with the strength of our community.\r\n\r\nWith each person installing the app for themselves and getting the smartphones of 3 other people installed with Bluezone. The Ministry of Information and Communications and the Ministry of Health recommend that the whole country install Bluezone for themselves and for 3 others.\r\n\r\n- Data security: Bluezone stores data on your device only, it does not send such data to the system.\r\n- No location data collection: Bluezone does not collect data on your location.\r\n- Anonymity: All Bluezoners are anonymous to others. Only competent health authorities know those who are infected and those who are suspected of infection due to close contact with COVID-19 cases.\r\n- Transparency: The Project is open source under GPL 3.0. license. Users from other countries are free to learn the operations of the system at source code level, and to use, research, modify and share it.\r\n\r\nBluezone also provides the following utilities:\r\n- Health: Give statistics of your daily steps.\r\n- Vaccination: Manage and Remind the vaccination schedule\r\n- Calendar: Look up the Solar calendar, the Lunar calendar\r\n- Female health: Track the menstrual cycle and fertility\r\n\r\nPrivacy Policy & Terms of Use: https://bluezone.ai/privacy-policy-terms-of-use\r\n\r\n----------------------------\r\nIf you have any difficulty in installing or using Bluezone, please contact us for assistance. The development team of Bluezone is making efforts to make it more and more complete, serving the country and the people in fighting against the COVID-19 pandemic.\r\n- Website: https://bluezone.gov.vn/\r\n- Email: contact@bluezone.gov.vn', 630, 'iconBluezone.png'),
(31, 5, 'COVID-19', 'medical', 2, 'COVID-19.zip', 0, '2.2', '2021-05-15 12:47:46', '2021-05-15 12:47:46', 'COVID-19 is a free application developed by the cooperation between Advanced International Joint Stock Company (AIC Group) and Electronic Health Administration - Ministry of Health, Viet Nam. It provides ultimate guidances for preventing and fighting against respiratory diseases caused by a new strain of coronavirus (officially named COVID-19).\r\nFeatures:\r\n- Virtual Medical Assistant (Chatbot): conducts one-on-one conversations with users by human sounding voice, works in real time and answers the questions about COVID-19 on the spot;\r\n- Board-certified Specialist Consultation: allow people to interact with a group of specialists at National Hospital for Tropical Diseases by chatting, audio/video calling for medical advices.\r\n- Interactions between Government and citizens: Users can send comments, requests, supports, and travel or health declaration. Users also can get the most recent advices and notices from the Government, WHO, CDC, NHC, Johns Hopkins University and other medical instituations.\r\n- COVID-19 Live Updates: shows live statistics and rolling updates from coronavirus disease in Viet Nam and the world. The numbers of cases per day, per week, per month, confirmed cases, increased numbers, etc. are analyzed and visually shown in map, graphics, number tables with comparisons and simulations by a group of data analysts continuously working 24/7.\r\n- COVID-19 Map: automatically synchronizes world wide data from WHO, CDC, NHC, etc.\r\n- Prevention of COVID-19: provides guidances documents, videos, animation clips from WHO, Ministry of Health, Viet Nam and other medical institutions.\r\n- Medical Facility GPS: enables users to search nearby hospitals, pharmacies, and certified COVID-19 test labs.', 1053, 'iconCovid-19.jpg'),
(33, 5, 'Google Translate', 'reference', 2, 'GoogleTranslate.zip', 20000, '6.17.0', '2021-05-15 12:53:36', '2021-05-15 12:53:36', '• Text translation: Translate between 108 languages by typing\r\n• Tap to Translate: Copy text in any app and tap the Google Translate icon to translate (all languages)\r\n• Offline: Translate with no internet connection (59 languages)\r\n• Instant camera translation: Translate text in images instantly by just pointing your camera (94 languages)\r\n• Photos: Take or import photos for higher quality translations (90 languages)\r\n• Conversations: Translate bilingual conversations on the fly (70 languages)\r\n• Handwriting: Draw text characters instead of typing (96 languages)\r\n• Phrasebook: Star and save translated words and phrases for future reference (all languages)\r\n• Cross-device syncing: Login to sync phrasebook between app and desktop\r\n• Transcribe: Continuously translate someone speaking a different language in near real-time (8 languages)\r\n\r\nTranslations between the following languages are supported:\r\nAfrikaans, Albanian, Amharic, Arabic, Armenian, Azerbaijani, Basque, Belarusian, Bengali, Bosnian, Bulgarian, Catalan, Cebuano, Chichewa, Chinese (Simplified), Chinese (Traditional), Corsican, Croatian, Czech, Danish, Dutch, English, Esperanto, Estonian, Filipino, Finnish, French, Frisian, Galician, Georgian, German, Greek, Gujarati, Haitian Creole, Hausa, Hawaiian, Hebrew, Hindi, Hmong, Hungarian, Icelandic, Igbo, Indonesian, Irish, Italian, Japanese, Javanese, Kannada, Kazakh, Khmer, Kinyarwanda, Korean, Kurdish (Kurmanji), Kyrgyz, Lao, Latin, Latvian, Lithuanian, Luxembourgish, Macedonian, Malagasy, Malay, Malayalam, Maltese, Maori, Marathi, Mongolian, Myanmar (Burmese), Nepali, Norwegian, Odia (Oriya), Pashto, Persian, Polish, Portuguese, Punjabi, Romanian, Russian, Samoan, Scots Gaelic, Serbian, Sesotho, Shona, Sindhi, Sinhala, Slovak, Slovenian, Somali, Spanish, Sundanese, Swahili, Swedish, Tajik, Tamil, Tatar, Telugu, Thai, Turkish, Turkmen, Ukrainian, Urdu, Uyghur, Uzbek, Vietnamese, Welsh, Xhosa, Yiddish, Yoruba, Zulu\r\n\r\nPermissions Notice\r\nGoogle Translate may ask for permission to access the following features:\r\n• Microphone for speech translation\r\n• Camera for translating text via the camera\r\n• SMS for translating text messages\r\n• External storage for downloading offline translation data\r\n• Accounts and credentials for signing-in and syncing across devices', 590, 'iconGoogleTranslate.png'),
(34, 5, 'Zing MP3', 'music', 2, 'ZingMP3.zip', 0, '21.05.01', '2021-05-15 12:57:56', '2021-05-15 12:57:56', 'Zing MP3 là ứng dụng nghe nhạc miễn phí hàng đầu Việt Nam. Với kho nhạc chất lượng cao đồ sộ từ http://mp3.zing.vn bạn sẽ có trải nghiệm âm nhạc tuyệt vời nhất trên thiết bị di động của mình.\r\nCác tính năng nổi bật:\r\n- Chơi được hầu hết các định dạng nhạc phổ biến, hỗ trợ cả nhạc lossless.\r\n- Có widget, music controller ở thanh thông báo và cả ở màn hình khóa.\r\n- Điều khiển nhạc thông qua tai nghe (có thể nhấn 2 lần/3 lần nút play (pause) để next/prev), hiển thị thông tin bài hát lên các thiết bị Bluetooth\r\n- To/nhỏ dần âm lượng khi tiếp tục/dừng, chuyển bài\r\n- Hỗ trợ các hiệu ứng âm thanh, điều chỉnh bass, balance, virtualizer và reverb\r\n- Tìm kiếm thông minh bằng giọng nói, hỗ trợ cả tiếng Việt\r\n- Bật ứng dụng lên để duyệt/phát khi nhấn vào link một bài hát/video/album/playlist/ca sỹ trên website mp3.zing.vn\r\n- Xem video chất lượng cao với nhiều độ phân giải khác nhau từ 240p đến 1080p\r\n- Hiển thị đầy đủ thông tin bài hát như tên album, hình album, tên ca sỹ, tên bài hát, lời bài hát cho cả nhạc offline lẫn nhạc online\r\n- Download nhạc 128kbps không giới hạn, user có tài khoản Zing VIP có thể download nhạc 320kbps và nhạc lossless (.flac)\r\n- Nghe nhạc online chất lượng cao (320kbps)\r\n- Quản lý bài hát, playlist, yêu thích… như trên website mp3.zing.vn\r\n- Trình chơi nhạc offline và online thông minh\r\n- Tạo, quản lý và chơi nhạc theo playlist offline\r\n- Có ngôn ngữ tiếng Anh bên cạnh tiếng Việt\r\n- Hỗ trợ Chromecast\r\n- Hỗ trợ Android Auto\r\n\r\nCác quyền cần cung cấp:\r\n- READ_PHONE_STATE: Zing MP3 chỉ sử dụng quyền này để tạm dừng nhạc khi có cuộc gọi đến.\r\n- WRITE_EXTERNAL_STORAGE: Quyền này cho phép Zing MP3 có thể tải nhạc về và lưu trữ trên bộ nhớ của thiết bị.\r\n\r\nĐiều khoản sử dụng: https://zingmp3.vn/tos.html\r\nChính sách bảo mật: https://zingmp3.vn/privacy.html\r\nBáo lỗi, góp ý xin gửi về apps@mp3.zing.vn', 1091, 'iconZingMP3.png'),
(35, 5, 'Shopee', 'shopping', 2, 'Shopee.zip', 0, '2.71.13', '2021-05-15 13:03:35', '2021-05-15 13:03:35', 'Chào mừng đến SHOPEE - điểm đến cho mọi nhu cầu mua sắm, bán hàng và giải trí. Ứng dụng được cải tiến liên tục để mang đến cho bạn trải nghiệm mua bán vui vẻ nhất.\r\n\r\nMUA SẮM ONLINE NHANH CHÓNG MỌI LÚC, MỌI NƠI\r\n● Dễ dàng tìm kiếm sản phẩm chất lượng với giá tốt nhất từ lượng hàng phong phú trong và ngoài nước. Bên cạnh sản phẩm tiêu dùng, bạn còn có thể mua voucher dịch vụ, nạp tiền điện thoại và đặt ship đồ ăn nhanh NowFood.\r\n● An tâm mua sắm từ các shop bán hàng uy tín được người mua đánh giá và bình chọn. Đặc biệt, khi mua sắm trong mục Shopee Mall, bạn sẽ được đảm bảo hàng chính hãng 100% hoặc hoàn tiền gấp đôi.\r\n● Thoải mái đặt ship hàng đến bất cứ đâu trong Việt Nam. Shopee đang liên kết với các đơn vị vận chuyển hàng uy tín như Giao Hàng Nhanh, Giao Hàng Tiết Kiệm,… để sản phẩm được giao tận nơi người nhận nhanh nhất có thể.\r\n\r\nTẬN HƯỞNG KHUYẾN MÃI ĐỘC QUYỀN VÀ MIỄN PHÍ GIAO HÀNG TOÀN QUỐC\r\n● Miễn phí khi tạo tài khoản Shopee. Một tài khoản có thể sử dụng cho cả việc mua sắm và bán hàng online\r\n● Nhận ngay một món quà xịn xò khi bạn mua hàng lần đầu trên Shopee\r\n● Tận hưởng thời gian vui vẻ cùng bạn bè và người thân khi tham gia các trò chơi của Shopee. Đồng thời, nhận đến hàng triệu Shopee Xu mỗi tháng. Với 1 Xu, bạn sẽ được hoàn 1 VND khi mua sắm tại Shopee.\r\n● Mua hàng online cực tiết kiệm với Flash Sale 1K, deals giá Rẻ Vô Địch, Mã giảm giá và Mã miễn phí giao hàng toàn quốc\r\n\r\nTHANH TOÁN GIAO DỊCH ĐƠN GIẢN\r\nThuận tiện mua sắm online trên Shopee với phương thức thanh toán đa dạng. Bạn có thể thanh toán khi nhận hàng (COD), thanh toán online qua liên kết ngân hàng hoặc bằng ví điện tử Airpay.\r\n\r\nAPP SHOPEE KHÁC GÌ VỚI WEBSITE SHOPEE?\r\n● Được chọn quà xịn xò khi bạn là khách hàng mới của Shopee\r\n● Nhận được thông báo về hot sale mỗi ngày và ưu đãi dành cho người bán\r\n● Xem các shop bán hàng livestream qua tính năng Shopee Live\r\n● Tham gia được hết các game hay của Shopee như Lắc Siêu Xu và nhiều trò chơi khác nữa\r\n● Nạp tiền điện thoại hay đặt ship đồ ăn NowFood với mã giảm giá Shopee\r\n\r\n-------------------\r\nTải app Shopee ngay và trải nghiệm mua bán online cực dễ dàng! Chúng tôi hân hạnh được lắng nghe và phục vụ bạn.\r\n\r\nSHOPEE là trang mua bán online hàng đầu tại Việt Nam với +30 triệu lượt truy cập mỗi tháng (theo iPrice). Ngoài Việt Nam, Shopee còn hoạt động ở Singapore, Đài Loan, Indonesia, Malaysia, Philippines và Thái Lan.\r\n\r\n*WEBSITE Shopee Việt Nam: www.shopee.vn\r\n*Shopee trên FACEBOOK: facebook.com/ShopeeVN\r\n*Shopee trên INSTAGRAM : @shopee_vn\r\n*Hotline tư vấn, hỗ trợ 24/7: 19001221', 1453, 'iconShopee.png'),
(36, 5, 'PUBG MOBILE VN', 'game', 2, 'PubgMobileVN.zip', 50000, '1.4.0', '2021-05-15 13:10:25', '2021-05-15 13:10:25', '★★★ MÔ TẢ CHUNG ★★★\r\nPUBG Mobile - PLAYERUNKNOWN\'S BATTLEGROUNDS MOBILE là game bắn súng sinh tồn được yêu thích trên toàn thế giới do Tencent & BlueHole nghiên cứu, phát triển và đã được phát hành chính thức tại Việt Nam, duy nhất bởi VNG.\r\n\r\n★★★ GAME PLAY ★★★\r\nKhi tham gia trò chơi, bạn sẽ cùng 99 người chơi khác nhảy dù xuống một hòn đảo hoang để tham gia vào trận chiến sinh tồn. Vòng bo sẽ thu hẹp dần, người chơi phải chạy vào bo để tồn tại. Thu thập súng và trang bị, chiến đấu hành động với những người chơi khác và sử dụng mọi chiến thuật để có thể sống sót đến cuối cùng.\r\n\r\n★★★ ĐẶC SẮC ★★★\r\n1. Đồ hoạ & âm thanh chuẩn HD\r\nTrò chơi sử dụng công nghệ Unreal Engine 4 mang lại trải nghiệm đồ hoạ chân thật, âm thanh sống động. Người chơi sẽ đóng vai 1 nhân vật hành động trong game, đem lại cảm giác trải nghiệm như 1 bộ phim hành động điện ảnh chân thực.\r\n2. Thỏa mãn đam mê về Súng\r\nSúng là niềm cảm hứng bất tận trong trò chơi, bên cạnh đó còn những vũ khí vô cùng đặc biệt đã đồng hành cùng thương hiệu PUBG như chiếc “Chảo Thần Thánh”, “Mũ 3”, \"Giáp 3\"… để người chơi có thể kết hợp chiến thuật tốt nhất và tạo nên những câu chuyện troll nhau không bao giờ hết.\r\n3. Cưỡi xe loot thính\r\nThỏa đam mê loot thính, cưỡi con xe chất nhất – đó là những trải nghiệm không thể bỏ qua khi chơi game bắn súng sinh tồn.\r\n4. Giao lưu năm châu bốn bể - chơi game là có bạn\r\nKhi trải nghiệm trong game, bạn có cơ hội làm quen với bạn bè khắp nơi trên thế giới với tính năng voice chat trong PUBG VN, đồng thời bạn luôn có cảm giác được chia sẻ, lắng nghe và ủng hộ.\r\n5. Rank & thi đấu\r\nSinh tồn là chưa đủ, phải trường tồn. Hệ thống nhiệm vụ & Rank phong phú đa dạng trong mobile PUBG giúp các bạn không ngừng chứng tỏ kỹ năng bất tử của mình.\r\n6. Tạo hình & Trang phục\r\nNgoại trang trong thể loại bắn súng sinh tồn PUBGM được thiết kế tinh xảo như thật. Bạn có thể tự sáng tạo khuôn mặt & chọn cho mình những trang phục thời trang được thiết kế tỉ mỉ, chau chuốt, mặc lên người những bộ đồ Richkid thời thượng.\r\n7. Hợp tác với Metro Exodus\r\nSự kết hợp đặc biệt giữa PUBG MOBILE và Metro Exodus chắc chắn sẽ mang lại cho bạn trải nghiệm sinh tồn vô cùng chân thực và kịch tích! Không chỉ mang đến bầu không khí nguy hiểm và thời tiết khó chịu, bạn còn phải hợp tác với đồng đội thu thập vật tư, sử dụng chiền thuật và quay về căn cứ an toàn!\r\n8. Chỉ 600 MB\r\nGiảm dung lượng ứng dụng chỉ còn 600 MB. Tự do tùy chọn tải và xóa các tiện ích của game theo nhu cầu. Tối ưu dung lượng theo từng dòng máy, đem đến trải nghiệm phù hợp dành cho bạn.\r\n\r\nĐây không phải trò chơi, đây là PUBG MOBILE VN!\r\n\r\n★★★YÊU CẦU CẤU HÌNH★★★\r\n* Khi tham gia game mobile PUBG VN người chơi cần kết nối internet liên lục.\r\n* Cấu hình khuyến nghị để có trải nghiệm tốt nhất khi chơi PUBG MOBILE VN: Android 5.1.1 hoặc cao hơn và ít nhất 2 GB RAM.\r\nPhiên bản hiện tại hỗ trợ hơn 500 thiết bị Android.\r\n\r\n★★★YÊU CẦU QUYỀN TRUY CẬP★★★\r\nĐể người chơi có sự trải nghiệm mượt mà, game[PUBG MOBILE VN] cần các quyền sau: Bộ nhớ(READ/WRITE_EXTERNAL_STORAGE): dùng để truy cập các file game và thực hiện các tính năng của trò chơi (chụp hình trận đấu hay và chia sẻ cho bạn bè). Chúng tôi chỉ sử dụng các quyền trên cho mục đích của game, không lưu bất cứ thông tin cá nhân của người chơi!\r\n\r\n★★★ HỖ TRỢ ★★★\r\nNếu bạn có bất kỳ câu hỏi hoặc quan tâm nào, vui lòng liên hệ với bộ phận chăm sóc khách hàng của chúng tôi theo địa chỉ\r\n\r\nTrang chủ: https://pubgm.zing.vn\r\nEmail: pubgm@vng.com.vn', 2134, 'iconPubgMobileVN.png'),
(39, 5, 'Angry Birds', 'game', 2, 'AngryBirds.zip', 0, '2.52', '2021-05-15 14:05:01', '2021-05-15 14:05:01', 'Join hundreds of millions of players for FREE and start the fun slingshot adventure now! Team up with your friends, climb the leaderboards, gather in clans, collect hats, take on challenges, and play fun events in all-new game modes. Evolve your team and show your skills in the most exciting Angry Birds game out there!\r\n\r\nGet to know all of the iconic characters and experience the fun gameplay that has captured the hearts of millions of players.\r\n\r\nFeatures:\r\n\r\n● DAILY CHALLENGES. Have a minute? Complete a daily challenge and earn some quick rewards.\r\n● LEVEL UP your characters with feathers and up their scoring power. Build the ultimate flock!\r\n● JOIN A CLAN to take down the pigs with friends and players around the world.\r\n● COMPETE in the ARENA. Compete with other players for some friendly bird flinging fun and prove who is the best.\r\n● COLLECT SILLY HATS. Collect hats with different fun themes to level up your flock’s fashion game and take part in special events.\r\n● IMPRESS THE MIGHTY EAGLE in special challenges in Mighty Eagle’s Bootcamp and earn coins to use in his exclusive shop.\r\n● LOTS OF LEVELS. Play hundreds of levels with more added in regular updates and limited time events.\r\n● LEADERBOARDS. Compete with your friends and other players and prove who is the best on the global leaderboards.\r\n● CHOOSE YOUR BIRD. Choose which bird to put in the slingshot and defeat the pigs with strategy!\r\n● MULTI-STAGE LEVELS. Play fun, challenging levels with multiple stages – just watch out for Boss Pigs!\r\n● FREE to download! --- Angry Birds 2 is completely free to play. Although Angry Birds 2 can be downloaded for free, there are optional in-app purchases available.\r\n\r\n---\r\n\r\nThis game may include:\r\n- Direct links to social networking websites that are intended for an audience over the age of 13.\r\n- Direct links to the internet that can take players away from the game with the potential to browse to any web page.\r\n- Advertising of Rovio products and also products from third parties.\r\n\r\nAlthough some features are available offline, this game may require internet connectivity for certain features. Normal data transfer charges apply. Note: When the game is played for the first time, there is a one-time download of additional content that cannot be completed while offline.\r\n\r\nTerms of use: http://www.rovio.com/terms-of-service\r\nPrivacy Policy: http://www.rovio.com/privacy', 1379, 'iconAB.png'),
(40, 5, 'BÁO MỚI', 'news', 2, 'Baomoi.zip', 0, '21.04.01', '2021-05-15 14:09:10', '2021-05-15 14:09:10', 'Baomoi là một website tổng hợp thông tin tiếng Việt hoàn toàn được điều khiển tự động bởi máy tính. Mỗi ngày gần 6500 tin tức từ gần 200 nguồn chính thức của các báo điện tử và trang tin điện tử Việt Nam được Baomoi tự động tổng hợp, phân loại, phát hiện các bài đăng lại, nhóm các bài viết liên quan và hiển thị theo sở thích đọc tin của từng độc giả.\r\n\r\nCách đọc tin trực tuyến của mọi người hiện nay thường là thụ động. Chúng ta vào một (hoặc nhiều) nguồn tin ưa thích, tìm những chuyên mục ưa thích và đọc theo kiểu \"có gì đọc nấy\". Baomoi ra đời để làm thay đổi phần nào thói quen đó, giúp cho độc giả Việt Nam có thể chủ động nhiều hơn với tin tức trực tuyến, món ăn tinh thần mỗi ngày. Baomoi là câu trả lời cho những vấn đề sau:\r\n\r\na. Tôi muốn biết những sự kiện hot nhất diễn ra trong ngày hoặc trong thời gian vừa qua?\r\nb. Tôi muốn theo dõi tất cả các thông tin (tin tức, videoclip, hình ảnh) về một chủ đề mà tôi quan tâm (vd: Điện ảnh Hàn Quốc, Web 2.0...)\r\nc. Tôi muốn tìm đọc những thông tin khác liên quan đến chủ đề của bài viết tôi đang đọc (về một ca sĩ, một đội bóng, một công ty...)\r\nd. Tôi chỉ muốn xem những thông tin mà tôi thích (vd: clip bóng đá, tin tức IT, ảnh người mẫu thời trang...)\r\ne. Tôi chỉ muốn xem duy nhất 1 lần các tin mà các website đăng lại của nhau\r\n\r\nCác tính năng chính\r\n- Phân loại nội dung: Hệ thống tự động phân tích nội dung các tin tức và phân loại vào chuyên mục thích hợp.\r\n- Phát hiện bài trùng lặp: Hệ thống tự động phát hiện các bài đăng lại (copy) và nhóm chúng lại về bài nội dung gốc.\r\n- Nhóm các bài liên quan: Hệ thống tự động phát hiện các bài liên quan (không phải là copy) về cùng một chủ đề nào đó.\r\n- Bóc tách từ khóa: Hệ thống tự động tách ra các từ khóa (keyword) của bài viết, giúp người đọc dễ dàng tìm kiếm các thông tin liên quan đa chiều.\r\n- Gợi ý thông minh: Dựa trên phân tích thói quen đọc tin của độc giả, hệ thống có thể tự động đưa ra những gợi ý về những bài viết mà độc giả quan tâm.\r\n\r\nĐiều khoản sử dụng: https://m.baomoi.com/staticpages/terms.epi\r\nChính sách bảo mật: https://m.baomoi.com/staticpages/privacy.epi\r\nEmail hỗ trợ: apps.baomoi@epi.com.vn', 1346, 'iconBaomoi.png'),
(41, 5, 'Garena', 'entertainment', 2, 'Garena.zip', 50000, '2.9.3', '2021-05-15 14:13:30', '2021-05-15 14:13:30', 'Garena serves both PC and Mobile games. On Garena, you gain access to the best games and all the wonderful features our platform has to offer. Play your favorite games, win tons of prizes, and make a lot of friends.\r\n\r\nGames:\r\nPlay top hit mobile games.\r\n\r\nGame Assist:\r\nCheck out extensive game statistics about yourself, your friends, and even your opponents. View your match records and share your game achievements.\r\n\r\nMagic Spin:\r\nWin rewards for many PC and mobile games.\r\n\r\nChats:\r\nChat with your Garena buddies anytime, even if they are on the PC.', 471, 'iconGarena.png'),
(42, 5, 'Spotify', 'music', 2, 'Spotify.zip', 50000, '8.6.26', '2021-05-15 14:16:35', '2021-05-15 14:16:35', 'With Spotify, you can listen to music and play millions of songs and podcasts for free. Stream music and podcasts you love and find music - or your next favorite song - from all over the world.\r\n\r\n• Discover new music, albums, playlists and podcasts\r\n• Search for your favorite song, artist, or podcast\r\n• Enjoy music playlists and an unique daily mix made just for you\r\n• Make and share your own playlists\r\n• Explore the top songs from different genres, places, and decades\r\n• Find music playlists for any mood and activity\r\n• Listen to music and more on your mobile, tablet, desktop, PlayStation, Chromecast, TV, and speakers\r\n\r\nPlay podcasts and music for free on your mobile and tablet with Spotify. Download albums, playlists, or just that one song and listen to music offline, wherever you are.\r\n\r\nWith Spotify, you have access to a world of free music, curated playlists, artists, and podcasts you love. Discover new music, podcasts, top songs or listen to your favorite artists, albums. Create your own music playlists with the latest songs to suit your mood.\r\n\r\nSpotify makes streaming music easy with curated playlists and thousands of podcasts you can’t find anywhere else. Find music from new artists, stream your favorite album or playlist and listen to music you love for free.\r\n\r\n• Free music and podcasts made easy – Listen to a playlist, album, or the top songs from any genre on shuffle mode.\r\n\r\nListen to music and podcasts on your tablet for free\r\n• Play any song, artist, podcast, album, or playlist and enjoy a personalised music experience with a daily mix to match your taste.\r\n\r\nSpotify Premium features\r\n• Listen to an album, playlist, or podcast without ad breaks. With Spotify you can play music by any artist, at any time on any device--mobile, tablet, or your computer.\r\n• Download to listen to music offline, wherever you are.\r\n• Jump back in and listen to your top songs.\r\n• Enjoy amazing sound quality on personalized music and podcasts.\r\n• Discover new music, a daily mix or curated playlists that suit your mood. With Spotify you’ll get a personalized music experience like no other.\r\n• No commitment - cancel any time you like.\r\n\r\nWant to discover new music?\r\nFind music that you’ll love today! Explore our curated music playlists, top songs and albums, or get personalized music recommendations with your daily mix.\r\n\r\nLove Spotify?\r\nLike us on Facebook: http://www.facebook.com/spotify\r\nFollow us on Twitter: http://twitter.com/spotify\r\n\r\nPlease note: This app features Nielsen’s audience measurement software which will allow you to contribute to market research, such as Nielsen’s Audio Measurement. If you don\'t want to participate, you can opt-out within the app settings. To learn more about our digital audience measurement products and your choices in regard to them, please visit http://www.nielsen.com/digitalprivacy for more information.', 1311, 'iconSpotify.png');
INSERT INTO `app` (`id`, `devid`, `name`, `type`, `status`, `file`, `price`, `ver`, `date`, `dateupdate`, `mota`, `size`, `icon`) VALUES
(43, 5, 'Gojek', 'travel', 1, 'Gojek.zip', 0, '4.19.1', '2021-05-15 14:19:44', '2021-05-15 14:19:44', 'Gojek is beyond an app for online transportation, food delivery, logistics, payment, and daily services.\r\n\r\nGojek is also an app with a social mission: to improve the welfare and livelihoods of the Indonesian people. How? By empowering people!\r\n\r\nBy today, Gojek has partnered with over 1 million drivers, 125.000 merchants, and 30.000 other services, spread across 50 cities in Indonesia.\r\n\r\nBy downloading the app and using Gojek services, not only will you help our partners make running errands easier for you, you\'ll also help make their and their family\'s dreams come true. YOU play a part in the mission to improve the lives of the people in Indonesia, every time you make a booking/order and use our services!\r\n\r\nGojek app has a lot of uber cool features and services. Here\'s everything you can do with it!\r\n\r\nGoing somewhere? You can choose one from three: GoRide, GoCar, or GoBluebird. When you’re lost? GoTransit is here to save your day and provide you with the choices of convenient routes.\r\n\r\nHungry? We have GoFood, the service for food delivery. When you’re bored at home and want to explore the best cuisine in your city, try GoFood pickup and pay your food with GoPay to minimize human contact.\r\n\r\nNeed to buy phone credits, mobile data packages or you just want to pay your bills? It\'s now easier with GoTagihan!\r\n\r\nBuying groceries is done easier with GoMart or GoShop, while GoMed takes care of your health without going to the pharmacy. Don’t worry, JD.id, Blibli, and e-commerce is also accessible in Gojek if you want to buy something to spruce up your life ;)\r\n\r\nFor logistical needs, our GoSend or GoBox troops are ready to help you.\r\n\r\nLet’s also say goodbye to long queues. You can get your movie or event tickets via GoTix!\r\n\r\n\r\nWant to pay for the Prakerja program to level up your skill? You can just GoPay it! #GoPayforPrakerja\r\n\r\nUpgrade your account to GoPlay Plus to enjoy PayLater (your savior when your balance is low). All you need to do is to register. Every GoPay Plus account has the right to get a cashback!* It’s convenient and safe.\r\n\r\nLet’s use GoPay to pay everything, hassle-free. It\'s simple and super quick! You can transfer GoPay balance to your friends and withdraw it to your bank. All you have to do is verify your GoPay and register your bank account.\r\n\r\nSo, what are you waiting for? Download now!\r\n\r\n*Terms and Conditions applied', 1373, 'iconGojek.png'),
(44, 5, 'Kenh14.vn', 'news', 2, 'Kenh14.zip', 0, '10.9', '2021-05-15 14:22:35', '2021-05-15 14:22:35', 'Đây là ứng dụng đọc tin chính thức của Kênh 14 - trang tin điện tử dành cho giới trẻ lớn nhất Việt Nam. Đem tới những tin tức siêu tốc, độc quyền, hỗ trợ đọc tin dễ dàng, nâng cao trải nghiệm nhờ ứng dụng công nghệ tiên tiến. Với sự đầu tư bài bản, chỉn chu trong từng chuyên mục, App đọc tin kenh14 hứa hẹn trở thành công cụ cập nhật tin tức không thể thiếu của giới trẻ thời đại số:\r\n\r\nStar: Biết hết chuyện Showbiz với các TIN HOT về đời sống, scandals... Gặp gỡ thần tượng trong nước và thế giới qua những tin tức ĐỘC QUYỀN chỉ có ở kênh 14\r\n\r\nTV show: Đi sâu hậu trường, thông tin bên lề của những chương trình truyền hình HOT NHẤT HIỆN TẠI\r\n\r\nCine: Không bỏ sót bất kỳ bộ phim nào, đem tin tức thế giới điện ảnh thu nhỏ trong điện thoại của bạn\r\n\r\nMusik: CẬP NHẬT các bài hát mới nhất, \"\"mổ xẻ\"\" MV, bật mí câu chuyện của những người trong nghề\r\n\r\nBeauty & Fashion: ĐÓN ĐẦU mọi xu hướng, giúp độc giả định hình phong cách cá nhân\r\n\r\nVideo: Mang lại cho người dùng trải nghiệm thưởng thức các video có nội dung cực hấp dẫn với tốc độ nhanh nhất, chất lượng đẹp nhất\r\n\r\nEmagazine: DUY NHẤT và CHỈ CÓ ở kenh14, nơi giới trẻ sử dụng ngôn ngữ hiện đại và hình ảnh độc đáo để nói lên những góc khuất, phá vỡ định kiến.', 1047, 'iconKenh14.jpg'),
(45, 5, 'HryFine', 'sports', 1, 'HryFine.zip', 0, '1.5.0', '2021-05-15 14:26:41', '2021-05-15 14:26:41', 'HryFine is an application that integrates data and services for wearable products to provide users with a complete, unified and convenient experience. With this application, you can: (1) Receive calls reminders, SMS reminders, synchronous SMS, address book, Remote photo taking, third-party app message real-time push, etc. (2) Check the bracelet\'s power, Bluetooth anti-lost warning and device search. (3) Support languages are Simplified Chinese, Traditional Chinese, English, German, French, Spanish, Italian, Japanese, Russian, etc.\r\n', 500, 'iconHryFine.png'),
(46, 5, 'Weather Live', 'weather', 2, 'WeatherLive.zip', 0, '7.2.5', '2021-05-15 14:30:10', '2021-05-15 14:30:10', 'Check the weather around you and all over the world at a glance.\r\nRely on the accurate weather forecast and adjust your schedule to the weather coming in. You won’t even have to look out the window as the app will bring current weather just inside your house!\r\n\r\nWeather is sometimes difficult to predict. This accurate weather app allows to find out a detailed 14 day weather forecast (7 in the free version) wherever you are, for any time of the day or for the next days just by tapping on the icons:\r\n- Current and “Feels like” temperature\r\n- Lightning tracker\r\n- Wind speed and direction\r\n- Pressure and precipitation weather information\r\n- Sunrise/sunset time\r\n- Weather Radar & Rain maps\r\n- Visibility (weather conditions for driving)\r\n- Weather alerts & current condition notifications\r\nand other useful weather data accompanied by live animations and graphics.\r\n\r\nWant to customize the way the weather is displayed? You can easily switch between detailed or compact layout to get weather information that is relevant for you. By the way, you can even rearrange weather blocks to spot first things first!\r\n\r\nIn addition, you can check the weather forecast even without opening the app. A visually appealing widget is easily integrated into your screen. You can set up the weather widget in any of the nine handy options. Choose a detailed full-size widget or keep your home screen as clean as possible with just the essential weather information.\r\n\r\nGo Premium and get access to interactive weather maps for the whole duration of your plan. Moreover,, become a Premium user and enjoy ad-free weather on your device.\r\n\r\nYou can choose from different subscription options:\r\n* A subscription with a free trial will automatically renew to a paid subscription unless you cancel the subscription before the end of the free trial period.\r\n* Cancel a free trial or subscription anytime through your account settings on the Google Play Store and continue to enjoy the premium content until the end of the free-trial period or paid subscription!\r\n\r\nPlease note that some supplementary features & weather details in the basic (free) version are subject to limitations (ex. UV index, 14 day weather forecast, Sun and Moon, Lightning tracker, Visibility, Air Quality index etc.). These limitations are also subject to change.\r\n\r\nBy downloading this application, you agree to the Apalon Apps End User License Agreement and Privacy Policy.\r\n\r\nA clear and simple live weather app will show you everything you need to know about the weather in any part of the world. Use the weather app to stay tuned with mother nature right on your device.\r\n\r\nEnjoy the perfect balance of beautiful pixels and accurate weather forecast!\r\n\r\nPrivacy Policy: http://apalon.com/privacy_policy.html\r\nCalifornia Privacy Notice: https://apalon.com/privacy_policy.html#h\r\nEULA: http://www.apalon.com/terms_of_use.html\r\nAdChoices: http://www.apalon.com/privacy_policy.html#4', 757, 'iconWeatherLive.png'),
(47, 5, 'Google Chrome', 'utilities', 2, 'GoogleChrome.zip', 0, '90.0.4430.78', '2021-05-15 14:34:54', '2021-05-15 14:34:54', 'Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your favorite sites, downloads, and Google Search and Google Translate built-in. Download now to enjoy the same Chrome web browser experience you love across all your devices.\r\n\r\nBrowse fast and type less. Choose from personalized search results that instantly appear as you type and quickly browse previously visited web pages. Fill in forms quickly with Autofill.\r\n\r\nIncognito Browsing. Use Incognito mode to browse the internet without saving your history. Browse privately across all your devices.\r\n\r\nSync Chrome Across Devices. When you sign into Chrome, your bookmarks, passwords, and settings will be automatically synced across all your devices. You can seamlessly access all your information from your phone, tablet, or laptop.\r\n\r\nAll your favorite content, one tap away. Chrome is not just fast for Google Search, but designed so you are one tap away from all your favorite content. You can tap on your favorite news sites or social media directly from the new tab page. Chrome also has the “Tap to Search”- feature on most webpages. You can tap on any word or phrase to start a Google search while still in the page you are enjoying.\r\n\r\nProtect your phone with Google Safe Browsing. Chrome has Google Safe Browsing built-in. It keeps your phone safe by showing warnings to you when you attempt to navigate to dangerous sites or download dangerous files.\r\n\r\nFast downloads and view web pages and videos offline Chrome has a dedicated download button, so you can easily download videos, pictures, and entire webpages with just one tap. Chrome also has downloads home right inside Chrome, where you can access all the content you downloaded, even when you are offline.\r\n\r\nGoogle Voice Search. Chrome gives you an actual web browser you can talk to. Use your voice to find answers on-the-go without typing and go hands free. You can browse and navigate quicker using your voice anywhere, anytime.\r\n\r\nGoogle Translate built-in: Quickly translate entire web pages. Chrome has Google Translate built in to help you to translate entire web to your own language with one tap.\r\n\r\nUse less mobile data and speed up the web. Turn on Lite mode and use up to 60% less data. Chrome can compress text, images, videos, and websites without lowering the quality.\r\n\r\nSmart personalized recommendations. Chrome creates an experience that is tailored to your interests. On the new tab page, you will find articles that Chrome selected based on your previous browsing history.', 1308, 'iconGoogleChrome.png'),
(48, 5, 'Google Maps', 'utilities', 2, 'GoogleMaps.zip', 0, '5.68', '2021-05-15 14:37:37', '2021-05-15 14:37:37', 'Navigate your world faster and easier with Google Maps. Over 220 countries and territories mapped and hundreds of millions of businesses and places on the map. Get real-time GPS navigation, traffic, and transit info, and explore local neighborhoods by knowing where to eat, drink and go - no matter what part of the world you’re in.\r\n\r\nGet there faster with real-time updates\r\n• Beat traffic with real-time ETAs and traffic conditions\r\n• Catch your bus, train, or ride-share with real-time transit info\r\n• Save time with automatic rerouting based on live traffic, incidents, and road closures\r\n\r\nDiscover places and explore like a local\r\n• Discover local restaurant, events, and activities that matter to you\r\n• Know what’s trending and new places that are opening in the areas you care about\r\n• Decide more confidently with “Your match,” a number on how likely you are to like a place\r\n• Group planning made easy. Share a shortlist of options and vote in real-time\r\n• Create lists of your favorite places and share with friends\r\n• Follow must-try places recommended by local experts, Google, and publishers\r\n• Review places you’ve visited. Add photos, missing roads and places.\r\n\r\nMore experiences on Google Maps\r\n• Offline maps to search and navigate without an internet connection\r\n• Street View and indoor imagery for restaurants, shops, museums and more\r\n• Indoor maps to quickly find your way inside big places like airports, malls and stadiums\r\n\r\n* Some features not available in all countries\r\n\r\n* Navigation isn\'t intended to be used by oversized or emergency vehicles', 985, 'iconGoogleMaps.png'),
(49, 5, 'MakeupPlus', 'beauti', 2, 'MakeupPlus.zip', 0, '5.5.6', '2021-05-15 14:41:27', '2021-05-15 14:41:27', 'Say hello to your own personal makeup artist! Our MakeupPlus app gets you looking gorgeous with a few easy touches. We\'ve worked with industry professionals such as top makeup artists and photographers to create a personal makeup and beauty advisor for you. There\'s no easier way to try out new looks or create your own signature look! Our MakeupPlus camera lets you try on complete looks then mix and match with fun accessories. Touch up your features, glam-up with our makeup looks, and purchase the products you love to recreate your favorite looks in real life – you can easily do it all with MakeupPlus.\r\nEXCLUSIVE looks created by beauty industry\'s best\r\n+ Try out exclusive makeup looks created by the beauty industry’s top professionals\r\n+ Get an instant makeover by the industry\'s best makeup artists such as Bretman Rock, Nikkie Tutorials, Lisa Eldridge, Christen Dominique, Angel Merino aka Mac Daddyy and others!\r\nMIX and MATCH full-face makeup looks with fun accessories\r\nTransform how you look right before your eyes with our augmented reality (AR) camera.\r\n+ Instantly preview glamorous full-face makeovers with fun accessories including retro style sunglasses, angel halos and more!\r\n+ Choose from a list of beautifully-crafted looks including a sweet look with \"Bella\", a whimsical look with \"Brazen\", or even a dark and sultry look with \"Porcelain\"\r\n+ Mix and match full-face makeovers with different looks to create your own style\r\nLOVE your look\r\nConsider yourself a makeup guru? Show off your creativity by putting together your own signature look in TOUCH-UP.\r\n+ If you\'re feeling bold, try out fun colors to see how you\'d look all glammed up\r\n+ Add easy makeup touches to your selfies to look on-point in every photo you post #dressyourface\r\n+ Go wild and change your hair color to the hottest trends. Try \"Cotton Candy\", \"Sunset\", or even \"Icy Blue\" for a mystic look\r\n+ Enhance the color of your eyes by adding colorful contact lenses with our easy applicator\r\nTRY out real beauty products\r\nTake the guesswork out of buying makeup online! With our COUNTER function, you can see how makeup products look in real-time with our AR camera.\r\n+ Instantly try on products from your favorite brands such as Charlotte Tilbury, GLAMGLOW, Stila, Clarins, NARS, Dior and more!\r\n+ Like what you see? With the touch of a button, it\'s yours! You can buy the items you love right on our app and start taking photos to show your friends\r\nBEAUTIFY your photo to enhance your natural features\r\n+ Retouch your skin to bring out your naturally radiant glow\r\n+ Easily show off your best features by making minor adjustments to your face, eyes, chin or nose\r\nADDITIONAL features\r\n+ Discover easy-to-follow makeup tips to make the most of our camera and makeup application tools in TRENDING\r\n+ Take the best group photos with our selfie timer and multiple face recognition function\r\n+ MakeupPlus works with both your front and back camera so take your pick!\r\nSHARE your photos\r\nOnce you\'re satisfied with your look, MakeupPlus makes it easy for you to download or share your photo on popular social media sites such as Facebook, Instagram, and Twitter!\r\nShare your photos and feedback with us!\r\nFacebook: http://www.facebook.com/makeupplusofficial\r\nTwitter: @makeupplusapp\r\nInstagram: @makeupplusapp\r\nDevice compatibility\r\nMost MakeupPlus features are compatible with most devices. However, our AR feature requires at least 1GB of storage space and a minimum resolution of 480 x 854. If your device does not meet these specific requirements, the AR feature will not be available.', 1874, 'iconMakeupPlus.png'),
(50, 4, 'Candy Crush Soda Saga', 'game', 2, 'CandyCrush.zip', 0, '1.201.0.3', '2021-05-15 15:09:21', '2021-05-15 15:09:21', 'Download Candy Crush Soda Saga now!\r\n\r\nFrom the makers of the legendary Candy Crush Saga comes Candy Crush Soda Saga! Unique candies, more divine matching combinations and challenging game modes brimming with purple soda and fun!\r\n\r\nThis mouth-watering puzzle adventure will instantly quench your thirst for fun. Join Kimmy on her juicy journey to find Tiffi, by switching and matching your way through new dimensions of magical gameplay. Take on this Sodalicious Saga alone or play with friends to see who can get the highest score!\r\n\r\nShow your competitive side in the Episode Race! Compete against other players to see who can complete levels the fastest and progress the quickest. Or work as a team in the Social Bingo feature where players work together for Sodalicious rewards!\r\n\r\nCandy Crush Soda Saga Features:\r\n\r\n', 1476, 'iconCandy.png'),
(51, 4, 'Daylio', 'utilities', 2, 'Daylio.zip', 0, '8.65', '2021-05-15 15:12:31', '2021-05-16 02:45:09', 'Daylio enables you to keep a private journal without having to type a single line. Try this beautifully designed & stunningly simple micro-diary app right now for FREE!\r\n\r\n\r\n', 0, 'iconDaylio.png'),
(52, 4, 'POPS KIDS', 'kids', 2, 'PopsKids.zip', 0, '4.3.409', '2021-05-15 15:16:18', '2021-05-15 15:16:18', 'POPS Kids is the leading educational and entertaining platform for children. This kid-friendly app offers a rich variety of content in music, entertainment and education categories.\r\n\r\nRegularly updated and tightly controlled, POPS Kids is a safe and rewarding entertainment app for kids offering parents a peace of mind while children enjoy the content.\r\n\r\nHow POPS Kids Platform works for kids\r\nWith a simple design and advanced recommendation system, children can easily find their favorite content to learn and grow in a fun and safe space. Notable content includes:\r\n- The Best Japan anime including Doraemon, Pokémon, Maruko Chan, etc.\r\n- Music for kids from Mam Choi La, CoComelon, Little Baby Bum and music videos from child superstars like Bao Ngu, Phan Hieu Kien, Bao An, Gia Khiem, Ku Tin, Candy Ngoc Ha, Quoc Duong, Hoang Bach, Hong An, and more.\r\n- Timeless educational programs for kids like Stem, We Learn We Play, Pincode, Bibabibo, BabyRiki, Abadas, Kex and Kola, and much more.\r\n- Acclaimed series and cartoons for kids like B-family, Carino Coni, Sergeant Keroro, Doong Doong Friends..\r\n\r\nHow POPS Kids Platform works for parents\r\nWith POPS Kids Platform, parents receive peace of mind, with outstanding features that are safe for kids like:\r\n- Parental controls and security measures with passcodes to stop kids from using the entertainment app during times they aren’t supervised, provide you with simple controls over your child\'s usage habits.\r\n- A timer helps you set your kid’s screen time and balance the time allowed to watch videos on the app with other family activities.\r\n- Strict guidelines on child safety, managed and guaranteed by the POPS management systems, ensure only kid-friendly content is available on the app.\r\n- The POPS ecosystem provides accessibility across mobile, desktop, and smart TV.\r\n------------\r\nWebsite: https://kids.pops.vn/\r\nVietnam Fanpage: https://www.facebook.com/popskids/\r\nYouTube Channel: www.youtube.com/popskids', 1159, 'iconPopsKids.png'),
(53, 4, 'Grab Driver', 'travel', 2, 'GrapDriver.zip', 0, '1.163.0', '2021-05-15 15:20:02', '2021-05-15 15:20:02', 'GRAB DRIVER - THE APP FOR DRIVERS\r\n- Be your own boss. Earn more by driving with Grab whenever you want.\r\n- Track your earnings easily in the app.\r\n- Get access to exclusive benefits, training and support.\r\n\r\nWHAT IS GRAB?\r\nGrab is a smartphone app that efficiently matches Drivers with passengers. Whether you\'re a private vehicle driver hoping to fund your dreams, or a taxi driver looking for the most efficient way to get a passenger, Grab is the right partner for you.\r\n\r\nREADY TO GET STARTED?\r\nStep 1: Download and install the Grab Driver app.\r\nStep 2: Open the app, tap on \'Sign Up\', and we\'ll guide you step by step till you\'re ready to hit the road and start earning.\r\n\r\nDOWNLOAD THE GRAB DRIVER APP AND SIGN UP TODAY!\r\nStill have questions? Visit us at www.grab.com/driver/ for more info. Grab is currently available in Malaysia, Singapore, Indonesia, Thailand, Vietnam, Philippines, Myanmar and Cambodia.\r\n\r\nTo learn more about information used in our App, including for interest based advertising and cross-device tracking, and to exercise certain opt-out choices you may have, please refer to our Privacy Policy.\r\n\r\n---\r\nTerms of Service: https://grab.com/terms\r\nPrivacy policy: https://grab.com/privacy\r\nOpen source software attribution: www.grb.to/oss-attributions', 891, 'iconGrapDriver.png'),
(54, 4, 'Lazada', 'shopping', 2, 'Lazada.zip', 0, '6.73.1', '2021-05-15 15:24:18', '2021-05-15 15:24:18', 'Welcome to the new Lazada mobile app! Join over 140 million shoppers on Lazada across South East Asia for the best online shopping experience. Download and shop now to discover the best deal online.\r\n\r\n\r\n\r\n✨EVERYTHING YOU WANT IS IN LAZADA! ✨\r\nLazada lets you enjoy all the things that you want, from the top items, deals, and other surprises conveniently from your home. You can shop online from a wide assortment of products and the best items that you want. From the fresh options provided by LazMart, including everyday essentials, tech, and home items for your convenience. Enjoy the best products online with the best deals that are up for grabs! Get vouchers, discounts, Flash Sales, and Mega Offer that give you more options to shop and save. You can even get lucky with Free Shipping when you buy at the biggest dates that the platform has planned for. Shop anywhere and have your items delivered straight to you, all without any worries through Lazada!\r\n\r\n\r\n\r\nFIRST ORDER BENEFITS\r\nGet Exclusive vouchers for your first purchase. Get coins when you check in daily, collect vouchers from Lazada and Sellers every time you use the Lazada app!\r\n\r\nEXCLUSIVE OFFICIAL BRAND STORES\r\nShopping branded products comes with authenticity concerns. Now shop carefree from Official Brand Stores on LazMall guaranteeing 100% authentic products. Enjoy 10000+ Global brands at your fingertips like Nike, adidas, Maybelline, L’Oréal, Unilever, Nestle, P&G, Herschel, Ray-Ban, Pampers, and more.\r\n\r\nPERSONALIZED RECOMMENDATIONS\r\nShopping is made easy for you with Lazada superior product recommendation algorithm to ensure personalized products, deals and vouchers just for You\r\n\r\nLIVESTREAMS\r\nUnsure on what to buy online? You can check out the daily livestreams coming from the LazLive and from our Sellers in Feed feature to be entertained and informed of the latest products online. You can also get exclusive vouchers when watching these streams that you can also use on the app\r\n\r\nBUYER GUARANTEE\r\nCheck out the product reviews, see the seller ratings, and \'CHAT WITH SELLERS\' directly! Dissatisfied? Simply return for a full refund via the simple returns policies\r\n\r\nSECURE PAYMENT\r\nPay securely through multiple payment options available. Cash on Delivery, Lazada Installments, LazWallet and secure bank transactions are all offered by our app\r\n\r\nFLASH SALES & VOUCHERS\r\nShop More and Save More with our Flash Sales in limited time slots. Redeem the latest promo codes, Seller vouchers, Bank vouchers and discounts every day for the best prices.\r\n\r\nBEST CATEGORIES\r\nEnjoy effortless online shopping and home delivery coming from a huge variety of products in electronics, sports, beauty, digital, groceries, toys, cars & motorcycles, shoes, fragrances, health, men’s & women’s fashion, and much more\r\n\r\nIndonesia: Marketeers 2017 – Best WOW Brand for E-Commerce\r\n\r\nThailand: 2016-2017 Marketeer No.1 Brand Thailand – Online Shopping\r\n\r\nSingapore: Asia One People\'s Choice Awards 2015: Top 3 E-Retailers in Singapore\r\n\r\nPhilippines: Readers Digest Most Trusted Brand Award 2014 – Gold Standard\r\n\r\nCountries supported\r\nIndonesia, Malaysia, Philippines, Singapore, Thailand, and Vietnam\r\n\r\n*DISCLAIMER*\r\n\r\nRecently, we’ve been notified of several cases where our app is promoted fraudulently by some third-party advertisers, usually in the form of site redirection, fake vouchers and games. These types of ads are being promoted without our consent and we strictly condemn this type of behavior.\r\n\r\nIf you encounter any of these issues, please help us and copy the page URL found and report it to help@lazada.com with subject AAV so that we can put an end to this.', 2083, 'iconLazada.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bought`
--

CREATE TABLE `bought` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bought`
--

INSERT INTO `bought` (`id`, `uid`, `aid`, `date`) VALUES
(20, 1, 1, '2021-05-12 01:13:15'),
(21, 1, 4, '2021-05-12 01:13:25'),
(22, 2, 5, '2021-05-12 01:53:58'),
(23, 1, 3, '2021-05-12 01:56:19'),
(24, 3, 54, '2021-05-16 04:30:52'),
(25, 3, 51, '2021-05-16 04:31:04'),
(26, 3, 53, '2021-05-16 04:31:13'),
(27, 3, 52, '2021-05-16 04:31:39'),
(28, 3, 47, '2021-05-16 04:32:04'),
(29, 3, 1, '2021-05-16 04:33:19'),
(30, 3, 36, '2021-05-16 04:33:37'),
(31, 3, 42, '2021-05-16 04:33:51'),
(32, 3, 26, '2021-05-16 04:34:13'),
(33, 1, 42, '2021-05-16 04:35:16'),
(34, 1, 54, '2021-05-16 04:41:07'),
(35, 1, 53, '2021-05-16 04:41:18'),
(36, 3, 20, '2021-05-16 08:07:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `mathe` text NOT NULL,
  `menhgia` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `card`
--

INSERT INTO `card` (`id`, `mathe`, `menhgia`, `date`) VALUES
(3, '123', 50000, '2021-05-11 06:49:06'),
(4, '609a31ffa9993', 10000, '2021-05-11 07:27:59'),
(5, '609a31ffbeaba', 10000, '2021-05-11 07:27:59'),
(6, '609a31ffcc54f', 10000, '2021-05-11 07:27:59'),
(7, '256c7bba98', 20000, '2021-05-11 07:36:12'),
(8, '6de4cadca821', 1000, '2021-05-11 07:38:01'),
(10, '55013e62bc30', 10000, '2021-05-11 07:51:35'),
(13, 'bca33ab9e660', 500000, '2021-05-12 13:57:26'),
(14, '39a28de05490', 500000, '2021-05-12 13:57:26'),
(15, '5ad3800e9049', 500000, '2021-05-12 13:57:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cardhistory`
--

CREATE TABLE `cardhistory` (
  `id` int(11) NOT NULL,
  `mathe` text NOT NULL,
  `menhgia` int(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cardhistory`
--

INSERT INTO `cardhistory` (`id`, `mathe`, `menhgia`, `uid`, `date`) VALUES
(1, '123', 0, 1, '2021-05-11 06:00:00'),
(2, '12345', 0, 1, '2021-05-11 06:03:40'),
(3, '609d3e571a91', 0, 1, '2021-05-11 07:44:06'),
(4, 'd6918d2836ce', 500000, 21, '2021-05-15 08:24:27'),
(5, 'adea8c3d39a0', 500000, 3, '2021-05-16 04:33:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config`
--

CREATE TABLE `config` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `value` varchar(100) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `config`
--

INSERT INTO `config` (`id`, `value`) VALUES
('faviicon', 'https://img.icons8.com/nolan/344/apple-app-store.png'),
('home', 'http://localhost'),
('icon', 'https://img.icons8.com/cute-clipart/344/apple-app-store.png'),
('name', 'App Store');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` text COLLATE utf32_vietnamese_ci NOT NULL,
  `mota` text COLLATE utf32_vietnamese_ci NOT NULL,
  `sdt` varchar(15) COLLATE utf32_vietnamese_ci NOT NULL,
  `email` varchar(100) COLLATE utf32_vietnamese_ci NOT NULL,
  `diachi` text COLLATE utf32_vietnamese_ci NOT NULL,
  `avatar` text COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `cccdfront` text COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `cccdback` text COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `developer`
--

INSERT INTO `developer` (`id`, `uid`, `name`, `mota`, `sdt`, `email`, `diachi`, `avatar`, `cccdfront`, `cccdback`, `date`) VALUES
(1, 1, 'Admin Dev', 'Dev Everything', '0987654321', 'admin@admin.com', 'ai biet', NULL, NULL, NULL, '2021-05-12 11:44:55'),
(4, 2, 'Developer', 'Developer mota', '0123456789', 'Developer@Dev', 'Developer address', '/img/dev/android.png', '/img/dev/androids.png', '/img/dev/android-os.png', '2021-05-12 11:44:55'),
(5, 21, 'QNP Company', 'Nhà cung cấp với quy mô lớn, phát triển hiện đại, môi trường làm việc chuyên nghiệp, đáp ứng đủ các yêu cầu. ', '0822226618', 'developer@gmail.com', 'số 19, Nguyễn Hữu Thọ, p.Tân Phong, q.7, TP Hồ Chí Minh', '/img/dev/nini.png', '/img/dev/cccd trước.jpg', '/img/dev/cccd sau.png', '2021-05-15 08:30:44'),
(7, 3, 'test', '', '', '', '', NULL, NULL, NULL, '2021-05-15 17:18:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `forgottoken`
--

CREATE TABLE `forgottoken` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `forgottoken`
--

INSERT INTO `forgottoken` (`id`, `uid`, `token`, `date`) VALUES
(17, 1, 'f54524bd9cd227b3762c639099b28e7e', '2021-05-16 03:14:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imgapp`
--

CREATE TABLE `imgapp` (
  `id` int(11) NOT NULL,
  `ten` text DEFAULT NULL,
  `appid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `imgapp`
--

INSERT INTO `imgapp` (`id`, `ten`, `appid`) VALUES
(1, 'tiktok-1.png', 1),
(2, 'tiktok-2.png', 1),
(6, 'Hình-động-câu-hỏi.gif', 14),
(13, 'unnamed.png', 1),
(28, 'm3.png', 20),
(27, 'm2.png', 20),
(26, 'm1.png', 20),
(25, 'i3.png', 19),
(24, 'i2.png', 19),
(23, 'i1.png', 19),
(20, 'y1.png', 18),
(21, 'y2.png', 18),
(22, 'y3.png', 18),
(29, 't1.png', 21),
(30, 't2.png', 21),
(31, 't3.png', 21),
(32, 'z1.png', 22),
(33, 'z2.png', 22),
(34, 'z3.png', 22),
(35, '1621079389-f1.png', 17),
(36, '1621079389-f2.png', 17),
(37, '1621079389-f3.png', 17),
(38, 'g1.png', 23),
(39, 'g2.png', 23),
(40, 'g3.png', 23),
(41, 'zo1.png', 24),
(42, 'zo2.png', 24),
(43, 'zo3.png', 24),
(44, 'me1.png', 25),
(45, 'me2.png', 25),
(46, 'me3.png', 25),
(47, 'bae1.png', 26),
(48, 'bae2.png', 26),
(49, 'bae3.png', 26),
(50, 'fo1.png', 27),
(51, 'fo2.png', 27),
(52, 'fo3.png', 27),
(53, 'ne1.png', 28),
(54, 'ne2.png', 28),
(55, 'ne3.png', 28),
(56, 'yk1.png', 29),
(57, 'yk2.png', 29),
(58, 'yk3.png', 29),
(59, 'bz1.png', 30),
(60, 'bz2.png', 30),
(61, 'bz3.png', 30),
(62, 'bz4.png', 30),
(63, 'co1.png', 31),
(64, 'co2.png', 31),
(65, 'co3.png', 31),
(66, 'co4.png', 31),
(67, 'co5.png', 31),
(68, 'co6.png', 31),
(69, 'co7.png', 31),
(70, 'gt1.png', 33),
(71, 'gt2.png', 33),
(72, 'gt3.png', 33),
(73, 'zi1.png', 34),
(74, 'zi2.png', 34),
(75, 'zi3.png', 34),
(76, 'pee1.png', 35),
(77, 'pee2.png', 35),
(78, 'pee3.png', 35),
(79, 'pee4.png', 35),
(80, 'pee5.png', 35),
(81, 'pee6.png', 35),
(82, 'pee7.png', 35),
(83, 'pu1.png', 36),
(84, 'pu2.png', 36),
(85, 'pu3.png', 36),
(86, 'pu4.png', 36),
(87, 'pu5.png', 36),
(97, 'b1.png', 40),
(95, 'ab2.png', 39),
(96, 'ab3.png', 39),
(94, 'ab1.png', 39),
(98, 'b2.png', 40),
(99, 'b3.png', 40),
(100, 'ga1.png', 41),
(101, 'ga2.png', 41),
(102, 'ga3.png', 41),
(103, 'ga4.png', 41),
(104, 'p1.png', 42),
(105, 'p2.png', 42),
(106, 'p3.png', 42),
(107, '1621088371-g1.png', 43),
(108, '1621088371-g2.png', 43),
(109, '1621088371-g3.png', 43),
(110, 'g4.png', 43),
(111, 'k1.png', 44),
(112, 'k2.png', 44),
(113, 'k3.png', 44),
(114, 'h1.png', 45),
(115, 'h2.png', 45),
(116, 'h3.png', 45),
(117, 'h4.png', 45),
(118, 'w1.png', 46),
(119, 'w2.png', 46),
(120, 'w3.png', 46),
(121, 'gc1.png', 47),
(122, 'gc2.png', 47),
(123, 'gc3.png', 47),
(124, 'gc4.png', 47),
(125, 'gc5.png', 47),
(126, 'gc6.png', 47),
(127, '1621089444-m1.png', 48),
(128, '1621089444-m2.png', 48),
(129, '1621089444-m3.png', 48),
(130, 'mp1.png', 49),
(131, 'mp2.png', 49),
(132, 'mp3.png', 49),
(133, 'c1.png', 50),
(134, 'c2.png', 50),
(135, 'c3.png', 50),
(136, 'd1.png', 51),
(137, 'd2.png', 51),
(138, 'd3.png', 51),
(139, 'd4.png', 51),
(140, 'd5.png', 51),
(141, 'd6.png', 51),
(142, '1621091765-p1.png', 52),
(143, '1621091765-p2.png', 52),
(144, '1621091765-p3.png', 52),
(145, '1621091989-g1.png', 53),
(146, '1621091989-g2.png', 53),
(147, '1621091989-g3.png', 53),
(148, '1621091989-g4.png', 53),
(149, 'g5.png', 53),
(150, 'g6.png', 53),
(151, 'l1.png', 54),
(152, 'l2.png', 54),
(153, 'l3.png', 54),
(154, 'l4.png', 54),
(155, 'l5.png', 54),
(156, 'l6.png', 54),
(157, 'l7.png', 54);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `appid` int(11) NOT NULL,
  `rate` float NOT NULL DEFAULT 0,
  `binhluan` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `rate`
--

INSERT INTO `rate` (`id`, `userid`, `appid`, `rate`, `binhluan`, `date`) VALUES
(1, 3, 1, 5, 'Tốt', '2021-05-09 06:13:08'),
(2, 2, 1, 2.5, 'Gút chóp', '2021-05-10 06:13:08'),
(3, 2, 1, 2, 'asdasd', '2021-05-10 10:00:18'),
(4, 1, 1, 3, 'sđajoij\r\nkiu\r\n\r\nk\r\nk\r\n\r\n', '2021-05-10 10:04:24'),
(5, 1, 3, 2, 'Hayk', '2021-05-10 15:33:17'),
(6, 3, 20, 5, 'Tốt', '2021-05-16 08:07:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namedetail` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`id`, `name`, `namedetail`) VALUES
(1, 'game', 'Game'),
(2, 'beauti', 'Beauti'),
(5, 'music', 'Music'),
(6, 'comunicate', 'Comunicate'),
(7, 'utilities', 'Utilities'),
(8, 'sports', 'Sports'),
(9, 'books', 'Books'),
(10, 'food&drink', 'Food & Drink'),
(11, 'entertainment', 'Entertainment'),
(12, 'health', 'Health'),
(13, 'kids', 'Kids'),
(14, 'medical', 'Medical'),
(15, 'news', 'News'),
(16, 'shopping', 'Shopping'),
(17, 'travel', 'Travel'),
(18, 'weather', 'Weather'),
(19, 'music', 'Music'),
(20, 'reference', 'Reference');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(80) NOT NULL,
  `permission` int(11) NOT NULL,
  `money` bigint(20) NOT NULL DEFAULT 0,
  `avatar` int(11) NOT NULL DEFAULT 0,
  `birthday` timestamp NOT NULL DEFAULT current_timestamp(),
  `sdt` char(20) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `diachi` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `permission`, `money`, `avatar`, `birthday`, `sdt`, `email`, `diachi`, `date`) VALUES
(1, 'admin', 'Nguyễn Phú Quí', 'e10adc3949ba59abbe56e057f20f883e', 2, 100000, 4, '2021-04-22 08:20:57', '12345123', 'npq171@gmail.com', '123123', '2021-04-22 08:22:47'),
(2, 'developer1', '', 'e10adc3949ba59abbe56e057f20f883e', 1, 500000, 0, '2021-04-22 08:20:57', '', 'thu@gmail.com', '', '2021-04-22 08:22:47'),
(3, 'member1', 'Tên gì đó', 'e10adc3949ba59abbe56e057f20f883e', 0, 330000, 0, '2021-04-22 08:20:57', NULL, 'thu1@gmail.com', NULL, '2021-04-22 08:22:47'),
(17, 'member2', '', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '2021-04-22 08:20:57', NULL, 'asd@asd.com', NULL, '2021-04-22 08:22:47'),
(21, 'developer2', 'Developer 2', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 0, '2021-05-15 08:17:08', NULL, 'quocthai05022@gmail.com', NULL, '2021-05-15 08:17:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bought`
--
ALTER TABLE `bought`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cardhistory`
--
ALTER TABLE `cardhistory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `forgottoken`
--
ALTER TABLE `forgottoken`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `imgapp`
--
ALTER TABLE `imgapp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `app`
--
ALTER TABLE `app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `bought`
--
ALTER TABLE `bought`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `cardhistory`
--
ALTER TABLE `cardhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `forgottoken`
--
ALTER TABLE `forgottoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `imgapp`
--
ALTER TABLE `imgapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT cho bảng `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
