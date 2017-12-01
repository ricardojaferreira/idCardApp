# idCardApp
An app to create custom ID cards

## Basic Functionality
The app should create an ID Card in real time and export the information to JSON.

####Basic task List
- [x] Follow the design proposed by the image [case_study_2017_demo.png](casestudy/case_study_2017_demo.png).
- [x] **Preview Area:**
    - [x] Shows the changes in real time.
- [x] **Drop Images Area:**
    - [x] Drop Photo: The user can drop one image and the image should appear on the profile image of the Preview area.
    - [x] Drop Background: The user can drop one image and the image will update the background image of the preview area.
- [x] **Text Fields Area:** 
    - [x] The data entered on the input fields will update in real time the corresponding text on the preview area.
    - [x] The Background Size Selector updates the background style on the preview area.
    - [x] The Generate JSON button generates one JSON object and updates the Output area.
- [x] **Outpu Area:**
    - [x] Outputs the JSON generated on the Text Field Area.

####Extra task List
- [x] **Text Fields Area:**
    - [x] Add the option to change the text color in real time.

##STEP 1: [Design](255cf94d61189f29043c9d48c66e72a96010765e)
- [index.html](index.html) (entry page of the app)    
- [reset.css](styles/reset.css) (reset some annoying browser styles)
- [main.css](styles/main.css) (main styles of the app)
- [default_avatar.jpeg](images/default_avatar.jpeg) (just a placeholder for the preview Photo)
- [drag_and_drop.gif](images/drag_and_drop.gif) (An animated image for the drop areas)
##STEP 2: [Basic Functionality]()
- [cardprocess.js](scripts/cardprocess.js) (JS script that executes the basic functionality)
