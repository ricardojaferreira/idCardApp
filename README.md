# idCardApp
An app to create custom ID cards

## Basic Functionality
The app should create an ID Card in real time and export the information to JSON.

#### Basic task List
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

#### Extra task List
- [x] **Text Fields Area:**
    - [x] Add the option to change the text color in real time.
    - [ ] Add the option to add colors in hexadecimal code.
    - [ ] Save the colors on a database for future use.
- [x] **Save Cards:**
    - [x] Create a database to save the cards created.
    - [x] Save the images uploaded to the server.
    - [x] The homepage should have the ability to show the cards saved if any.
    - [x] Show the cards saved without reloading the page.
    - [ ] Update the card information without reloading the page.
    - [ ] Create a new card based on a previous saved card.
    - [ ] The user can create a background directly on the app, with the canvas or simply by choosing a solid color.
- [ ] **Users:**
    - [ ] Create a new user before using the app
    - [ ] Users Login and Logout
    - [ ] Save the cards for each user
    - [ ] Only show the cards created by the user
- [ ] **Design of the app**
    - [ ] Create a new design
    - [ ] Add responsive design
    - [ ] Give some configuration options to the user

## STEP 1: [Design](https://github.com/ricarraf/idCardApp/commit/255cf94d61189f29043c9d48c66e72a96010765e)
- [index.html](templates/homepage.php) (entry page of the app)    
- [reset.css](styles/reset.css) (reset some annoying browser styles)
- [main.css](styles/main.css) (main styles of the app)
- [default_avatar.jpeg](images/default_avatar.jpeg) (just a placeholder for the preview Photo)
- [drag_and_drop.gif](images/drag_and_drop.gif) (An animated image for the drop areas)

## STEP 2: [Basic Functionality](https://github.com/ricarraf/idCardApp/commit/ae62b991b99525bfd589d599301f31c5af6dc285)
- [cardprocess.js](scripts/cardprocess.js) (JS script that executes the basic functionality)

## STEP 3: [Extra Functionality]()
##### New App Folder Structure
- **[database folder](database/)**
    - [idcards.sql](database/idcards.sql)(SQL commands to generate the database)
    - [idcards.db](database/idcards.db)(The generated database using SQLITE3)
- **[images folder](images/)**
    - This is the location of all the images of the application even the uploaded images;
- **[includes folder](includes/)**
    - [db_connection.php](includes/db_connection.php)(Connection to the database);
    - [init.php](includes/init.php)(Includes all the necessary files for the application)
    - [session.php](includes/session.php)(File to add functions to handle sessions)
- **[templates folder](templates/)**
    - This folder has all the frontend templates of the app.
- [index.php](index.php)(This is now the entry point of the app)
- [action_saveid.php](action_saveid.php) (The action to save a new card to the database)
- [action_updatecard.php](action_updatecard.php) (Gets the information from the database and returns a JSON file)

## Things to improve
- The user should be able to save a card without a background image;
- Save the values entered when the page reloads after and error;
- Keep the image format when uploading (using the MIME type provided by the base64 string);
- Improve the AJAX tasks and functions;
- Create the database directly on the app to avoid problems with relocation;