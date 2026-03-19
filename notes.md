Patch 3.17.21.40 : 
- Started learning how laravel works 
- Will try to learn and create the Item module while implementing Service Layer ( Repository Layer isnt neccessary for the scale of the project ).
- In the mean time i will try to learn the 'shorcuts' in laravel ( learning how these things work automatically rather than me hardcoding it like in php native )
- Also started on trying out creating MVSC in this project

Patch 3.18.10.40 : 
- added a feature getAll Items for item module
- Added a base service to inherit common functions to other service that will use it.
- Migrate all of the common / helper function to BaseService.php for better readability and traceblitiy
- Another reminder to ignore the repository layer for the mean time till i could get a better use of it.

Patch 3.18.18.58 : 
- Added a new feature to handle item insertion within the inventory module.
- Implemented a validation check to ensure all required JSON keys are present before processing.
- Refactored the architecture by moving all database interactions from the Service into the Repository.
- Updated the Service layer to focus on business logic and standardizing the arrays returned to the Controller.
- Introduced a BaseRepository to house common helper functions used across the application.
- Added a $defaultStatus attribute and a handleExcept method to the Base Repository for consistent error handling.
- Ensured a cleaner separation of concerns by limiting the Service's role to data preparation and the Repository's role to database execution.

Patch 3.19.12.27 : 
- Added feature for updating item.
- Added private helper (requestToArray and createItemEntity) for easier readability and simpiclity.
- Added request validation to check necessary key needed

Patch 3.19.16.45 : 
- Added feature for deleting items permanently, will add a ways to soft delete in the future
- In progress adding a function to search by name ( commented )