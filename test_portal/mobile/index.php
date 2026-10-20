<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){
        $("btnNextPage").click(function(){
            var pageURL = $(location).attr("href");
            alert(pageURL);
        });
    });
</script>
<script type='text/javascript'> 
$(function() {
	// Set the data text
	var dataText = 'page=<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_SERVER['REQUEST_URI']; ?>&p=<?php echo $_GET['p']; ?>';

	// Create the AJAX request
	$.ajax({
		type: "POST",                    // Using the POST method
		url: "process.php",             // The file to call
		data: dataText,                  // Our data to pass
		success: function(data) {            // What to do on success
			$('#complete').html(data);
		},
                error: function () {
                    }
	});
});
</script>


<head>
<meta http-equiv="Content-Type" content=
"text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="SSW-OHS-007-PRC REV2 Corrective Maintenance_Neat" />
<meta name="Generator" content="Flip PDF Professional 1.10.3  at http://www.flipbuilder.com" />
<link rel="image_src" href="../files/shot.png">
<meta name="og:image" content="../files/shot.png">
<meta property="og:image" content="../files/shot.png">
<title>SSW-OHS-007-PRC REV2 Corrective Maintenance_Neat</title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />
 <meta name="apple-mobile-web-app-status-bar-style" content="black" />

<link rel="stylesheet" href="style/style.css" />
<script src="javascript/main.js"></script>
<script src="javascript/search_config.js"></script><script src="javascript/bookmark_config.js"></script>
<script language="javascript">	
	var aliasConfig = {
appName : ["", "", ""],
totalPageCount : [],
largePageWidth : [],
largePageHeight : [],
normalPath : [],
largePath : [],
thumbPath : [],

ToolBarsSettings:[],
TitleBar:[],
appLogoIcon:["appLogoIcon"],
appLogoLinkURL:["appLogoLinkURL"],
bookTitle : [],
bookDescription : [],
ButtonsBar : [],
ShareButton : [],
ShareButtonVisible : ["socialShareButtonVisible"],
ThumbnailsButton : [],
ThumbnailsButtonVisible : ["enableThumbnail"],
ZoomButton : [],
ZoomButtonVisible : ["enableZoomIn"],
FlashDisplaySettings : [],
MainBgConfig : [],
bgBeginColor : ["bgBeginColor"],
bgEndColor : ["bgEndColor"],
bgMRotation : ["bgMRotation"],
backGroundImgURL : ["mainbgImgUrl","innerMainbgImgUrl	"],
pageBackgroundColor : ["pageBackgroundColor"],
flipshortcutbutton : [],
BookMargins : [],
topMargin : [],
bottomMargin : [],
leftMargin : [],
rightMargin : [],
HTMLControlSettings : [],
linkconfig : [],
LinkDownColor : ["linkOverColor"],
LinkAlpha : ["linkOverColorAlpha"],
OpenWindow : ["linkOpenedWindow"],
searchColor : [],
searchAlpha : [],
SearchButtonVisible : ["searchButtonVisible"],

productName : [],
homePage : [],
enableAutoPlay : ["autoPlayAutoStart"],
autoPlayDuration : ["autoPlayDuration"],
autoPlayLoopCount : ["autoPlayLoopCount"],
BookMarkButtonVisible : [],
googleAnalyticsID : ["googleAnalyticsID"],
OriginPageIndex : [],	
HardPageEnable : ["isHardCover"],	
UIBaseURL : [],	
RightToLeft: ["isRightToLeft"],	

LeftShadowWidth : ["leftPageShadowWidth"],	
LeftShadowAlpha : ["pageShadowAlpha"],
RightShadowWidth : ["rightPageShadowWidth"],
RightShadowAlpha : ["pageShadowAlpha"],
ShortcutButtonHeight : [],	
ShortcutButtonWidth : [],
AutoPlayButtonVisible : ["enableAutoPlay"],	
DownloadButtonVisible : ["enableDownload"],	
DownloadURL : ["downloadURL"],
HomeButtonVisible :["homeButtonVisible"],
HomeURL:['btnHomeURL'],
BackgroundSoundURL:['bacgroundSoundURL']
}
	var bookConfig = {
	appName:'flippdf',
	totalPageCount : 0,
	largePageWidth : 1080,
	largePageHeight : 1440,
	normalPath : "files/page/",
	largePath : "files/large/",
	thumbPath : "files/thumb/",
	
	ToolBarsSettings:"",
	TitleBar:"",
	appLogoLinkURL:"",
	bookTitle:"FLIPBUILDER",
	bookDescription:"",
	ButtonsBar:"",
	ShareButton:"",
	
	ThumbnailsButton:"",
	ThumbnailsButtonVisible:"ShOW",
	ZoomButton:"",
	ZoomButtonVisible:"yES",
	FlashDisplaySettings:"",
	MainBgConfig:"",
	bgBeginColor:"#cccccc",
	bgEndColor:"#eeeeee",
	bgMRotation:45,
	backGroundImgURL:"",
	pageBackgroundColor:"#FFFFFF",
	flipshortcutbutton:"Show",
	BookMargins:"",
	topMargin:10,
	bottomMargin:10,
	leftMargin:10,
	rightMargin:10,
	HTMLControlSettings:"",
	linkconfig:"",
	LinkDownColor:"#808080",
	LinkAlpha:0.5,
	OpenWindow:"_Blank",

	BookMarkButtonVisible:'true',
	productName : 'Demo created by Flip PDF',
	homePage : 'http://www.flipbuilder.com/',
	isFlipPdf : "true"
};
	
	
	
	;bookConfig.barColor="0x000000";bookConfig.toobarClear="Yes";bookConfig.showToolBarBevel="Hide";bookConfig.appLogoIcon="../files/extfiles/appLogoIcon.png";bookConfig.aboutButtonVisible="Hide";bookConfig.fullButtonVisible="Show";bookConfig.helpButtonVisible="Hide";bookConfig.helpContentFileURL="../files/extfiles/helpContentFileURL.png";bookConfig.enablePrint="No";bookConfig.printWartermark="../files/extfiles/printWartermark.png";bookConfig.enableDownload="No";bookConfig.enableFlipSound="Enable";bookConfig.bacgroundSoundLoop="-1";bookConfig.enableZoomIn="Yes";bookConfig.showSinglePageFirst="No";bookConfig.minZoomWidth="700";bookConfig.maxZoomWidth="1400";bookConfig.zoomPageDoublePageMode="Yes";bookConfig.searchButtonVisible="Show";bookConfig.searchMinialLen="3";bookConfig.shareWithEmailButtonVisible="Hide";bookConfig.btnShareWithEmailBody="{link}";bookConfig.socialShareButtonVisible="Hide";bookConfig.languageSetting="English";bookConfig.langaugeChangeable="Yes";bookConfig.enableAutoPlay="Yes";bookConfig.autoPlayDuration="9";bookConfig.autoPlayLoopCount="1";bookConfig.autoPlayAutoStart="No";bookConfig.drawAnnotationsButtonVisible="Disable";bookConfig.UIBtnIconColor="0xECF5FB";bookConfig.bigNavButtonColor="0xC0C0C0";bookConfig.thicknessWidthType="Thinner";bookConfig.hotSpotWidthType="Normal";bookConfig.backgroundAlpha="1";bookConfig.moveFlipBookToCenter="Yes";bookConfig.flipBookHelpFlipEnable="True";bookConfig.enableMouseDownToFlip="True";bookConfig.showMouseTraceAtFirstPage="True";bookConfig.openThumbInit="False";bookConfig.tmplPreloader="Default";bookConfig.UIBtnFontColor="0xC6C6C6";bookConfig.UIBtnFont="Tahoma";bookConfig.UIBtnPageIndexFontColor="0x000000";bookConfig.normalTextColor="0xffffff";bookConfig.hightLightColor="0xA4B3F3";bookConfig.bgBeginColor="0xE2E2E2";bookConfig.bgEndColor="0xE2E2E2";bookConfig.bgMRotation="90";bookConfig.mainbgImgUrl="../files/extfiles/mainbgImgUrl.jpg";bookConfig.mainbgImgPosition="Scale to fit";bookConfig.mainColor="0xD0D0D0";bookConfig.thumbSelectedColor="0xFF8000";bookConfig.pageBackgroundColor="0xE8E8E8";bookConfig.pageWidth="650";bookConfig.pageHeight="900";bookConfig.pageShadowAlpha="0.5";bookConfig.isRightToLeft="No";bookConfig.isTheBookOpen="No";bookConfig.isHardCover="No";bookConfig.pageFlippingTime="0.6";bookConfig.mouseWheelTurnPage="Yes";bookConfig.userSmallMode="Yes";bookConfig.maxWidthToSmallMode="500";bookConfig.maxHeightToSmallMode="400";bookConfig.securitySetting="No Security";bookConfig.linkOverColor="0x800080";bookConfig.linkOverColorAlpha="0.2";bookConfig.linkOpenedWindow="Blank";bookConfig.linkEnableWhenZoom="Enable";bookConfig.totalPageCount=6;bookConfig.largePageWidth=1324;bookConfig.largePageHeight=1833;bookConfig.mainColor="#000000";bookConfig.BookMarkButtonVisible="false";bookConfig.bookTitle="SSW-OHS-007-PRC REV2 Corrective Maintenance_Neat";bookConfig.LinkDownColor="0x800080";bookConfig.LinkAlpha="0.2";bookConfig.OpenWindow="Blank";bookConfig.normalPath="../files/mobile/";bookConfig.largePath="../files/mobile/";bookConfig.productName="Flip PDF Professional";bookConfig.homePage="http://www.flipbuilder.com";var language = [{ language : "English",btnFirstPage:"First",btnNextPage:"Next Page",btnLastPage:"Last",btnPrePage:"Previous Page",btnDownload:"Download",btnPrint:"Print",btnSearch:"Search",btnClearSearch:"Clear",btnBookMark:"Bookmark",btnHelp:"Help",btnFullScreen:"Enable FullScreen",btnDisableFullScreen:"Disable FullScreen",btnSoundOn:"Sound On",btnSoundOff:"Sound Off",btnShareEmail:"Share",btnSocialShare:"Social Share",btnZoomIn:"Zoom In",btnZoomOut:"Zoom Out",btnAutoFlip:"Auto Flip",btnStopAutoFlip:"Stop Auto Flip",btnGoToHome:"Return Home",frmHelpCaption:"Help",frmHelpTip1:"Double click to zoom in or out",frmHelpTip2:"Drag the page corner to view",frmPrintCaption:"Print",frmPrintBtnCaption:"Print",frmPrintPrintAll:"Print All Pages",frmPrintPrintCurrentPage:"Print Current Page",frmPrintPrintRange:"Print Range",frmPrintExampleCaption:"Example: 2,5,8-26",frmPrintPreparePage:"Preparing Page:",frmPrintPrintFailed:"Print Failed:",pnlSearchInputInvalid:"(Minimal request length is 3 symbols)",loginCaption:"Login",loginInvalidPassword:"Not a valid password!",loginPasswordLabel:"Password:",loginBtnLogin:"Login",loginBtnCancel:"Cancel",btnThumb:"Thumbnails",lblPages:"Pages:",lblPagesFound:"Pages:",lblPageIndex:"Page",btnAbout:"About",frnAboutCaption:"About & Contact",btnSinglePage:"Single Page",btnDoublePage:"Double Page",btnSwicthLanguage:"Switch Language",tipChangeLanguage:"Please select a language below...",btnMoreOptionsLeft:"More Options",btnMoreOptionsRight:"More Options",btnFit:"Fit Window",smallModeCaption:"Click to view in fullscreen",btnAddAnnotation:"Add Annotations",btnAnnotation:"Annotations",FlipPageEditor_SaveAndExit:"Save and Exit",FlipPageEditor_Exit:"Exit",DrawToolWindow_Redo:"Redo",DrawToolWindow_Undo:"Undo",DrawToolWindow_Clear:"Clear",DrawToolWindow_Brush:"Brush",DrawToolWindow_Eraser:"Eraser",DrawToolWindow_Rectangular:"Rectangular",DrawToolWindow_Ellipse:"Ellipse",DrawToolWindow_TextNote:"Text Note"},{ language : "French",btnFirstPage:"Première page",btnNextPage:"Page suivante",btnLastPage:"Dernière page",btnPrePage:"Page précédente",btnDownload:"Télécharger",btnPrint:"Imprimer",btnSearch:"Recherche",btnClearSearch:"Clear",btnBookMark:"Marque page",btnHelp:"Aide",btnFullScreen:"Plein écran",btnDisableFullScreen:"Fenêtre",btnSoundOn:"Son",btnSoundOff:"Muet",btnShareEmail:"Partager",btnSocialShare:"Réseaux sociaux",btnZoomIn:"Zoom en",btnZoomOut:"Zoom hors",btnAutoFlip:"Auto Flip",btnStopAutoFlip:"Stop Auto Flip",btnGoToHome:"Début",frmHelpCaption:"Aide",frmHelpTip1:"Double click pour zoom In ou OUT",frmHelpTip2:"Tirer sur le coin de page",frmPrintCaption:"Imprimer",frmPrintBtnCaption:"Imprimer",frmPrintPrintAll:"Imprimer toutes les pages",frmPrintPrintCurrentPage:"Imprimer la page actuelle",frmPrintPrintRange:"Print Range",frmPrintExampleCaption:"Exemple: 2,5,8-26",frmPrintPreparePage:"Préparation de la page :",frmPrintPrintFailed:"Défaillance de l'impression",pnlSearchInputInvalid:"(La requette minimale et de 3 caractères",loginCaption:"Connexion",loginInvalidPassword:"Mot de passe invalide",loginPasswordLabel:"Mot de passe :",loginBtnLogin:"Connexion",loginBtnCancel:"Annuler",btnThumb:"Thumbnails",lblPages:"Pages :",lblPagesFound:"Pages :",lblPageIndex:"Page",btnAbout:"A propos",frnAboutCaption:"A propos et contact",btnSinglePage:"Page simple",btnDoublePage:"Double page",btnSwicthLanguage:"Changer de langue",tipChangeLanguage:"SVP sélectionnez la langue ci-contre",btnMoreOptionsLeft:"Plus d'options",btnMoreOptionsRight:"Plus d'options",btnFit:"Ajuster à la fenêtre",smallModeCaption:"Cliquez pour voir en plein écran",btnAddAnnotation:"Ajouter Annotations",btnAnnotation:"Annotations",FlipPageEditor_SaveAndExit:"Sauvegardez et quittez",FlipPageEditor_Exit:"Quitter",DrawToolWindow_Redo:"Refaire",DrawToolWindow_Undo:"Annuler",DrawToolWindow_Clear:"Clair",DrawToolWindow_Brush:"Brosse",DrawToolWindow_Eraser:"Gomme",DrawToolWindow_Rectangular:"Rectangulaire",DrawToolWindow_Ellipse:"Ellipse",DrawToolWindow_TextNote:"Note texte"},{ language : "German",btnFirstPage:"zum Anfang",btnNextPage:"weiter blättern",btnLastPage:"zum Ende",btnPrePage:"zurück blättern",btnDownload:"download",btnPrint:"drucken",btnSearch:"Suche",btnClearSearch:"Clear",btnBookMark:"Lesezeichen",btnHelp:"Hilfe",btnFullScreen:"Vollbild an",btnDisableFullScreen:"Vollbild aus",btnSoundOn:"Ton an",btnSoundOff:"Ton aus",btnShareEmail:"mitteilen",btnSocialShare:"Social Share",btnZoomIn:"einzoomen",btnZoomOut:"auszoomen",btnAutoFlip:"auto flip",btnStopAutoFlip:"stop auto flip",btnGoToHome:"Return Home",frmHelpCaption:"Hilfe",frmHelpTip1:"Zoom mit Doppelklick",frmHelpTip2:"mit der Maus an der Ecke ziehen",frmPrintCaption:"drucken",frmPrintBtnCaption:"drucken",frmPrintPrintAll:"alle Seiten drucken",frmPrintPrintCurrentPage:"aktuelle Seite drucken",frmPrintPrintRange:"Drucke Seiten",frmPrintExampleCaption:"Beispiel: 2,5,8-26",frmPrintPreparePage:"Seite wird vorbereitet",frmPrintPrintFailed:"Fehler beim Drucken",pnlSearchInputInvalid:"mindestens  3 Zeichen eingeben",loginCaption:"Passwort",loginInvalidPassword:"Passwort falsch",loginPasswordLabel:"Passwort:",loginBtnLogin:"login",loginBtnCancel:"Korrektur",btnThumb:"Seitenübersicht",lblPages:"Seiten:",lblPagesFound:"Seiten:",lblPageIndex:"Seite",btnAbout:"über",frnAboutCaption:"über + Kontakt",btnSinglePage:"Einzelseite",btnDoublePage:"Doppelseite",btnSwicthLanguage:"Sprache ändern",tipChangeLanguage:"wählen Sie eine Sprache aus",btnMoreOptionsLeft:"weitere Optionen",btnMoreOptionsRight:"weitere Optionen",btnFit:"Fenster anpassen",smallModeCaption:"Klicken Sie im Vollbildmodus anzuzeigen",btnAddAnnotation:"Hiinzufügen Anmerkungen",btnAnnotation:"Anmerkungen",FlipPageEditor_SaveAndExit:"Speichern und Beenden",FlipPageEditor_Exit:"Beenden",DrawToolWindow_Redo:"Redo",DrawToolWindow_Undo:"Rückgängig machen",DrawToolWindow_Clear:"Klar",DrawToolWindow_Brush:"Pinsel",DrawToolWindow_Eraser:"Radiergummi",DrawToolWindow_Rectangular:"Rechteckig",DrawToolWindow_Ellipse:"Ellipse",DrawToolWindow_TextNote:"Text Hinweis"},{ language : "Italian",btnFirstPage:"Prima",btnNextPage:"Pagina Successiva",btnLastPage:"Ultima",btnPrePage:"Pagina Precedente",btnDownload:"Download",btnPrint:"Stampa",btnSearch:"Cerca",btnClearSearch:"Clear",btnBookMark:"Segnalibro",btnHelp:"Aiuto",btnFullScreen:"Abilita Schermo Intero",btnDisableFullScreen:"Disabilita Schermo Intero",btnSoundOn:"Sound On",btnSoundOff:"Sound Off",btnShareEmail:"Condividi",btnSocialShare:"Condividi con il tuo Social Network",btnZoomIn:"Zoom In",btnZoomOut:"Zoom Out",btnAutoFlip:"Auto Flip",btnStopAutoFlip:"Stop Auto Flip",btnGoToHome:"Torna alla HomePage",frmHelpCaption:"Aiuto",frmHelpTip1:"Doppio click per zoom in o out",frmHelpTip2:"Posizionati sull'angolo della pagine per vedere",frmPrintCaption:"Stampa",frmPrintBtnCaption:"Stampa",frmPrintPrintAll:"Stampa Tutte le Pagine",frmPrintPrintCurrentPage:"Stampa la Pagina Corrente",frmPrintPrintRange:"Stampa un Intervallo",frmPrintExampleCaption:"Esempio: 2,5,8-26",frmPrintPreparePage:"Sto preparando la pagina:",frmPrintPrintFailed:"Stampa Fallita:",pnlSearchInputInvalid:"(Lunghezza minima richiesta è 3 simboli)",loginCaption:"Login",loginInvalidPassword:"Password non valida!",loginPasswordLabel:"Password:",loginBtnLogin:"Login",loginBtnCancel:"Annulla",btnThumb:"Anteprima",lblPages:"Pagine:",lblPagesFound:"Pagine:",lblPageIndex:"Pagina",btnAbout:"About",frnAboutCaption:"About & Contatti",btnSinglePage:"Pagina Singola",btnDoublePage:"Pagina Doppia",btnSwicthLanguage:"Scegli la Lingua",tipChangeLanguage:"Per favore seleziona una lingua qui sotto...",btnMoreOptionsLeft:"Piu' Opzioni",btnMoreOptionsRight:"Piu' Opzioni",btnFit:"finestra Fit",smallModeCaption:"Clicca per vedere a schermo intero",btnAddAnnotation:"Aggiungi Annotazioni",btnAnnotation:"Annotazioni",FlipPageEditor_SaveAndExit:"Salvare e Uscire",FlipPageEditor_Exit:"Exit",DrawToolWindow_Redo:"rifare",DrawToolWindow_Undo:"disfare",DrawToolWindow_Clear:"chiaro",DrawToolWindow_Brush:"spazzola",DrawToolWindow_Eraser:"gomma",DrawToolWindow_Rectangular:"rettangolare",DrawToolWindow_Ellipse:"ellisse",DrawToolWindow_TextNote:"testo Note"},{ language : "Chinese(Traditional)",btnFirstPage:"第一頁",btnNextPage:"下一頁",btnLastPage:"最後一頁",btnPrePage:"前一頁",btnDownload:"下載",btnPrint:"打印",btnSearch:"搜索",btnClearSearch:"清除",btnBookMark:"目錄",btnHelp:"幫助",btnFullScreen:"全屏",btnDisableFullScreen:"普屏",btnSoundOn:"打開聲音",btnSoundOff:"關閉聲音",btnShareEmail:"分享",btnSocialShare:"朋友分享",btnZoomIn:"放大",btnZoomOut:"縮小",btnAutoFlip:"自動翻頁",btnStopAutoFlip:"停止翻頁",btnGoToHome:"返回主頁",frmHelpCaption:"幫助",frmHelpTip1:"可以雙擊進行放大或縮小",frmHelpTip2:"拖動頁面的個角可以進行翻頁",frmPrintCaption:"打印",frmPrintBtnCaption:"打印",frmPrintPrintAll:"打印所有頁面",frmPrintPrintCurrentPage:"打印當前頁",frmPrintPrintRange:"打印範圍：",frmPrintExampleCaption:"例如：2,5,8-26",frmPrintPreparePage:"正在準備頁：",frmPrintPrintFailed:"打印失敗：",pnlSearchInputInvalid:"（最少需要輸入3個字符）",loginCaption:"登錄",loginInvalidPassword:"你輸入的密碼不正確！",loginPasswordLabel:"密碼：",loginBtnLogin:"登錄",loginBtnCancel:"取消",btnThumb:"縮略圖",lblPages:"頁數：",lblPagesFound:"找到頁數：",lblPageIndex:"頁",btnAbout:"關於",frnAboutCaption:"關於我們",btnSinglePage:"單頁",btnDoublePage:"雙頁",btnSwicthLanguage:"切換語言",tipChangeLanguage:"請在下面選擇一種語言",btnMoreOptionsLeft:"更多選擇",btnMoreOptionsRight:"更多選擇",btnFit:"自動適應",smallModeCaption:"點擊全屏",btnAddAnnotation:"加註釋",btnAnnotation:"註釋列表",FlipPageEditor_SaveAndExit:"注释列表",FlipPageEditor_Exit:"退出",DrawToolWindow_Redo:"重做",DrawToolWindow_Undo:"撤銷",DrawToolWindow_Clear:"清除",DrawToolWindow_Brush:"筆刷",DrawToolWindow_Eraser:"擦除",DrawToolWindow_Rectangular:"矩形",DrawToolWindow_Ellipse:"橢圓",DrawToolWindow_TextNote:"文字備註"}];;function orgt(s){ return binl2hex(core_hx(str2binl(s), s.length * chrsz));};bookConfig.thumbPath="../files/thumb/";; var pageEditor = [[],[],[],[],[],[]];
	
	
	
	
try{
	for(var i=0;pageEditor!=undefined&&i<pageEditor.length;i++){
		if(pageEditor[i].length==0){
			continue;
		}
		for(var j=0;j<pageEditor[i].length;j++){
			var anno=pageEditor[i][j];
			if(anno==undefined)continue;
			if(anno.overAlpha==undefined){
				anno.overAlpha=bookConfig.LinkAlpha;
			}
			if(anno.outAlpha==undefined){
				anno.outAlpha=0;
			}
			if(anno.downAlpha==undefined){
				anno.downAlpha=bookConfig.LinkAlpha;
			}
			if(anno.overColor==undefined){
				anno.overColor=bookConfig.LinkDownColor;
			}
			if(anno.downColor==undefined){
				anno.downColor=bookConfig.LinkDownColor;
			}
			if(anno.outColor==undefined){
				anno.outColor=bookConfig.LinkDownColor;
			}
			if(anno.annotype=='com.mobiano.flipbook.pageeditor.TAnnoLink'){
				anno.alpha=bookConfig.LinkAlpha;
			}
		}
	}
}catch(e){
}
</script>


</head>	
<body>
	
</body>
</html>
