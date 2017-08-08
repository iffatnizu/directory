<?php

class SiteConfig {

    CONST CONFIG_ADMIN_EMAIL = 'admin@directory.com';
    CONST SITE_MASTER = "siteMaster";

    //define modules
    CONST MOD_HEADER = 'mod/modHeader';
    CONST MOD_FOOTER = 'mod/modFooter';
    CONST MOD_TOP_MENUS = 'mod/modTopMenus';
    CONST MOD_LEFT_MENU = 'mod/modLeftMenu';

    //define component
    CONST COMPONENT_HOME = 'comp/home/compHome';
    
    CONST COMPONENT_SIGNUP = 'comp/user/compSignUp';
    CONST COMPONENT_USER_LOGIN = 'comp/user/compUserLogin';
    CONST COMPONENT_USER_INBOX = 'comp/user/compUserInbox';
    
    
    
    CONST COMPONENT_LOGIN = 'comp/user/compLogin';
    CONST COMPONENT_FAVORITE = 'comp/user/compFavorite';
    CONST COMPONENT_EDIT_PROFILE = 'comp/user/compEditProfile';
    CONST COMPONENT_CHANGE_PASSWORD = 'comp/user/compChangePassword';
    CONST COMPONENT_USER_MANAGE_RATING = 'comp/user/compManageRating';
    
    CONST COMPONENT_CATERING = 'comp/catering/compCatering';
    CONST COMPONENT_FOOD_PREFERENCE = 'comp/catering/compFoodPreference';
    CONST COMPONENT_FEW_QUESTIONS = 'comp/catering/compFewQuestions';
    CONST COMPONENT_OTHER_SERVICES = 'comp/catering/compOtherServices';
    
    CONST COMPONENT_RECEPTION = 'comp/reception/compReception';
    CONST COMPONENT_HALLS_QUOTES = 'comp/reception/compHallsQuotes';
    CONST COMPONENT_HALL_OTHER_SERVICES = 'comp/reception/compHallOtherServices';
    
    CONST COMPONENT_ENTERTAINERS = 'comp/entertainers/compEntertainers';
    CONST COMPONENT_DJS_REQUEST = 'comp/entertainers/compDjsRequest';
    CONST COMPONENT_DJ_OTHER_SERVICES = 'comp/entertainers/compDjOtherServices';
    
    CONST COMPONENT_FLORISTS = 'comp/florists/compFlorists';
    CONST COMPONENT_DECORATIVE_SERVICES = 'comp/florists/compDecorativeServices';
    
    CONST COMPONENT_PHOTOGRAPHERS = 'comp/photographers/compPhotographers';
    
    CONST COMPONENT_LIMOUSINE = 'comp/limos/compLimousine';
    
    CONST COMPONENT_HOW_IT_WORKS = 'comp/howitworks/compHowitworks';
    
    CONST COMPONENT_ABOUT_US = 'comp/about/compAboutUs';
    
    CONST COMPONENT_CONTACT_US = 'comp/contact/compContactUs';
    
    CONST COMPONENT_TERMS_OF_SERVICES = 'comp/terms/compTermsOfServices';
    CONST COMPONENT_PRIVACY_POLICY = 'comp/privacy/compPrivacyPolicy';
    CONST COMPONENT_AFFILIATE_ADVERTISEMENT = 'comp/affiliate/compAffiliateAdvertisement';
    
    CONST COMPONENT_VENDOR_DETAILS = 'comp/vendor/compVendorDetails';
    CONST COMPONENT_VENDOR_REGISTRATION = 'comp/vendor/compVendorRegistration';
    CONST COMPONENT_VENDOR_ACTIVATION = 'comp/vendor/compVendorActivation';
    CONST COMPONENT_VENDOR_DIRECTORY = 'comp/vendor/compVendorDirectory';
    CONST COMPONENT_VENDOR_SEARCH = 'comp/vendor/compVendorSearch';
    CONST COMPONENT_VENDOR_CHOOSING_SEARCH = 'comp/vendor/compChoosingSearch';
    CONST COMPONENT_VENDORS_OF_STATE = 'comp/vendor/compStateVendors';
    CONST COMPONENT_VENDORS_RATING_REVIEW = 'comp/vendor/compVendorRatingReview';
        
    CONST COMPONENT_QUOTE = 'comp/quote/compQuote';
    CONST COMPONENT_EVENT_INFO = 'comp/quote/compEventInfo';    
    CONST COMPONENT_QUOTE_INFORMATION = 'comp/quote/compQuetoInformation';
    CONST COMPONENT_ADD_REMOVE_SERVICES = 'comp/quote/compAddRemoveServices';
    CONST COMPONENT_CATERER = 'comp/quote/compCaterer';
    CONST COMPONENT_DECORATION = 'comp/quote/compDecoration';
    CONST COMPONENT_ENTERTAINER = 'comp/quote/compEntertainer';
    CONST COMPONENT_FLORIST = 'comp/quote/compFlorist';
    CONST COMPONENT_PHOTOGRAPHY = 'comp/quote/compPhotography';
    CONST COMPONENT_LIQUOR = 'comp/quote/compLiquor';
    
    CONST COMPONENT_FAQ = 'comp/faq/compFaq';
    
    CONST COMPONENT_EVENTS_ALL = 'comp/events/compAllEvents';
    CONST COMPONENT_EVENTS_DETAILS = 'comp/events/compEventsDetails';
    CONST COMPONENT_EVENTS_BOOKMARK = 'comp/events/compEventsBookmark';
    
    
    CONST COMPONENT_BOOKMARK_SERVICES = 'comp/bookmark/compBookmarkServices';
    
    

    //define controllers
    CONST CONTROLLER_HOME = 'home';
    CONST CONTROLLER_USER = 'user';
    CONST CONTROLLER_CATERING = 'catering';
    CONST CONTROLLER_RECEPTION = 'reception';
    CONST CONTROLLER_ENTERTAINERS = 'entertainers';
    CONST CONTROLLER_FLORISTS = 'florists';
    CONST CONTROLLER_PHOTOGRAPHERS = 'photographers';
    CONST CONTROLLER_LIMOS = 'limos';
    CONST CONTROLLER_HOW_IT_WORKS = 'howitworks';
    CONST CONTROLLER_ABOUT = 'about';
    CONST CONTROLLER_CONTACT = 'contact';
    CONST CONTROLLER_VENDOR = 'vendor';
    CONST CONTROLLER_QUOTE = 'quote';
    CONST CONTROLLER_TERMS = 'terms';
    CONST CONTROLLER_PRIVACY = 'privacy';
    CONST CONTROLLER_AFFILIATE = 'affiliate';
    CONST CONTROLLER_FAQ = 'faq';
    CONST CONTROLLER_EVENTS = 'events';
    CONST CONTROLLER_BOOKMARK = 'bookmark';
    CONST CONTROLLER_CONVERSATION = 'conversation';

    //define controllers methods
    CONST METHOD_HOME_INDEX = '/index';
    CONST METHOD_HOME_GET_CITY = '/getCity';
    
    CONST METHOD_USER_SIGNUP = '/signup';
    CONST METHOD_USER_LOGIN = '/login';
    CONST METHOD_USER_FAVORITE = '/favorite';
    CONST METHOD_USER_LOG_OUT = '/logout';
    CONST METHOD_USER_INBOX = '/inbox';
    CONST METHOD_USER_EDIT_PROFILE = '/editProfile';
    CONST METHOD_USER_CHANGE_PASSWORD = '/changePassword';
    CONST METHOD_USER_MANAGE_RATING = '/manageRating';
    CONST METHOD_USER_SUBSCRIBE = '/subscribe';
    CONST METHOD_USER_UPDATE_VENDOR_RATING_REVIEW = '/updateVendorRatingReview';
    
   
    
    CONST METHOD_CATERING_INDEX = '/index';
    CONST METHOD_CATERING_GET_QUOTES = '/getquotes';
    CONST METHOD_CATERING_FOOD_PREFERENCE = '/foodpreference';
    CONST METHOD_CATERING_FEW_QUESTIONS = '/fewquestions';
    CONST METHOD_CATERING_OTHER_SERVICES = '/otherservices';

    CONST METHOD_RECEPTION_INDEX='/index';
    CONST METHOD_RECEPTION_HALLS='/halls';
    CONST METHOD_RECEPTION_HALLS_QUOTES='/hallsquotes';
    CONST METHOD_RECEPTION_OTHER_SERVICES='/otherservices';
    
    CONST METHOD_ENTERTAINERS_INDEX='/index';
    CONST METHOD_ENTERTAINERS_DJS='/djs';
    CONST METHOD_ENTERTAINERS_DJS_REQUEST='/djsRequest';
    CONST METHOD_ENTERTAINERS_OTHER_SERVICES='/otherservices';
    
    CONST METHOD_FLORISTS_INDEX='/index';
    CONST METHOD_FLORISTS_REQUEST='/request';
    CONST METHOD_FLORISTS_DECORATIVE_SERVICES='/decorativeServices';
    
    CONST METHOD_PHOTOGRAPHERS_INDEX='/index';
    CONST METHOD_PHOTOGRAPHERS_PHOTOGRAPHY='/photography';
    
    CONST METHOD_LIMOS_INDEX='/index';
    CONST METHOD_LIMOS_LIMOUSINE='/limousine';
    
    CONST METHOD_VENDOR_DETAILS='/details/';
    CONST METHOD_VENDOR_REGISTRATION='/registration/';
    CONST METHOD_VENDOR_ACCOUNT='/account/';
    CONST METHOD_VENDOR_SEARCH = '/search';
    CONST METHOD_VENDOR_ADVANCE_SEARCH = '/advancesearch';
    CONST METHOD_VENDOR_DIRECTORY = '/directory';
    CONST METHOD_VENDOR_LOGIN = '/login';
    CONST METHOD_VENDOR_DO_LOGIN = '/doLogin';
    CONST METHOD_VENDOR_LOG_OUT = '/logout';
    CONST METHOD_VENDOR_PROFILE = '/profile';
    CONST METHOD_VENDOR_CHANGE_PASSWORD = '/changepassword';
    CONST METHOD_VENDOR_CHANGE_LOGO = '/changeLogo';
    CONST METHOD_VENDOR_SETTINGS = '/settings';
    CONST METHOD_VENDOR_EDIT_PROFILE = '/editprofile';
    CONST METHOD_VENDOR_DASHBOARD = '/dashboard';
    CONST METHOD_VENDOR_STATE_VENDORS = '/stateVendors';
    CONST METHOD_VENDOR_RATING_REVIEW = '/ratingReview';
    CONST METHOD_VENDOR_SEND_REPORT_FOR_RATING = '/sendReportForRating';
    CONST METHOD_VENDOR_ADD_TO_FAVORITE = '/addToFavorite';
    CONST METHOD_VENDOR_SUBMIT_REVIEW = '/submitReview';
    CONST METHOD_VENDOR_SUBMIT_RATING_AJAX = '/submitRatingAjax';
        
    CONST METHOD_QUOTE_INDEX='/index';
    CONST METHOD_QUOTE_SET_CATEGORY='/setCategory';
    CONST METHOD_QUOTE_EVENT_INFO='/eventInfo';
    CONST METHOD_QUOTE_GET_CITY_BY_STATE_ID='/getCityByStateId';
    CONST METHOD_QUOTE_ADD_REMOVE_SERVICES='/addRemoveServices';
    CONST METHOD_QUOTE_CATERER='/caterer';
    CONST METHOD_QUOTE_DECORATION='/decoration';
    CONST METHOD_QUOTE_ENTERTAINER='/entertainer';
    CONST METHOD_QUOTE_FLORIST='/florist';
    CONST METHOD_QUOTE_PHOTOGRAPHY='/photography';
    CONST METHOD_QUOTE_LIQUOR='/liquor';
    CONST METHOD_QUOTE_REMOVE_SERVICES='/removeService';
    CONST METHOD_QUOTE_INSERT_ALL_EVENT_INFO='/insertAllEventInfo';
    
    CONST METHOD_EVENTS_ALL = '/all';
    CONST METHOD_EVENTS_DETAILS = '/details';
    CONST METHOD_EVENTS_BOOKMARK = '/bookmark';
    CONST METHOD_EVENTS_BOOKMARK_SERVICE = '/bookmarkservice';
    CONST METHOD_EVENTS_REMOVE_BOOKMARK_SERVICE = '/removebookmarkservice';
    
    
    CONST METHOD_BOOKMARK_SERVICES = '/service';
    
    CONST METHOD_CONVERSATION_SEND_MESSAGE = '/sendMessage';
    CONST METHOD_CONVERSATION_INBOX = '/inbox';
    
    
    
    
}
