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

Patch 3.20.09.54 : 
- Added feature to searchByName in ItemService
- Added DTOs directory to store the DTO class.
- Added checking in insertion function in ItemService to check if an itemPrice is less than equals 0. To prevent invalid pricing.
- Added checking in findByName function in Item Service to check if a search query char len is greater than or equals 3
- Changed functions in ItemService to accept ItemDTO in their param and changed the logic aswell
- Refactored Item module by Using ItemDTO to when storing and updating items. Also changed the param in remove and search items to itemId and itemName instead of the old Request object. This changes is done to have a better readability of the code itself. 
- Removed helper function ( requestToArray ) in ItemService, since it will no longer need that. 
- Fixed helper function ( createItemEntity ) in its param so it could turn ItemDTO to a new ItemEntity

Patch 3.20.19.14 : 
- Started work on Bin module, added the base work a.k.a the controller, service, repository and model.
- Created bin table and its migration schema
- Realized that ive created duplicated schema but didnt use the other entity. Will delete the other schema and the duplicated bin table( bin tables and entity )
- Removed some unecessary 'use' inside itemService
- Removed TestController.php since its not being used anymore

Patch 3.20.23.28 : 
- Added attributes in BinEntity also added makeNew function and calculateId to generate random id.
- Moved returnInJson function to Controller since its a common function / helper function
- Added function arrForTest() to return array for testing
- Started working on fetchAll feature in Bin module

Patch 3.21.12.06 : 
- Added BinDTO for bin module.
- Finished laying the foundation for Bin Module will add the CRUD Feature later on.

Patch 3.21.15.00 : 
- Fixed a bug when inserting items. Changes made in each DTO where a null is converted into an empty string. Causing BinEntity id generation wont trigger. 
- Added Create (C) feature in Bin Module
- Fixed typo variable naming in BinEntity->calculateId()

Patch 3.21.22.52 : 
- Added deleteById feature in Bin
- Done big haul on repository, by standardizing all return should be array. 
- Added helper function handleReturnArr in handle repository for consitency
- Refactored all of service module bin and items.
- Added debug_err key in arrReturn to know if there are any errors inside the code.

Patch 3.22.08.01 : 
- Fixed a bug inside delete function in Bin Repo

Patch 3.22.13.00 : 
- Added update function in Bin module
- Reverted back to  stateless repository

Patch 3.22.23.30 : 
- Added DTO Layer between repo and service
- Added find By name in bin module

Patch 3.23.11.34 : 
- Finished All feature / function in Bin module
- Started work on Stock module
- Finished routing for stock module in api.php 
- Tried to create a dynamix routing in api.php (check comment section), will continue it later.

Patch 3.23.13.51 : 
- Starting to use DTO as a way to return results from repo -> service -> controller. Implemented first in Stock then in Bin and Item module.
- Fixed a bug where db variable in BaseRepository didnt have any pdo instances (forgot to getPdo)
- Added fetchAll func in Stock module.
- That's all for this afternoon, imma take a rest

Patch 3.23.20.41 : 
- Added insertion function in Stock Module
- Created stock_log table to store history of changes made to stock rather than storing single time data.

Patch 3.24.16.20 : 
- In this patch i only do one thing which is figuring how the heck am i gonna do an update on a stock transaction. Cuz i fucking confused on how this shit works. Then i remembered a something from my highschool days. Back in the day im really good with this bookkeeping keeping the journal entry, balance sheet and etc. Then i remembered that the same philosophy is we use debit and credit to track in and out and even changes or more fitting a ledger system. Turns out the transaction idea that i built is literally the same philosophy or logic as my old accouting lessons in high school. So i get to work on that immediately. 
- I also modified the stockDTO a bit to accomodate the business logic. 
- To sum it up this patch only brings the 'update' system or ledger transaction system in stock. It may seem small now, but trust me a few hours ago i was desperte on how figuring this out. So user now can edit the stock (increase and decrease quantity, change the binId or the bin where the item is currently in)

Patch 3.25.11.25 : 
- Fixed a bug in handleResponseUpdate
- TL:DR, i created the concept to "soft delete" a stock by balance out it aka inserting minus transaction based on the total quantity.
- But i happen to hit a bit of a hiccup on the road where SQLite LITERALLY LOCKS THE WHOLE DB WHEN WRITING, SO WHEN I INSERT A NEW TRANS WITH A NEW STOCK ID AND WHEN I INSERT TO ITS CHILDREN TABLE WITH THAT STOCK ID AS THE FOREIGN KEY. SQLITE SAYS FOREIGN KEY VIOLATION WHEN ITS LITERALLY SITTING THERE. 
- Oh well, i ll try to think of another loophole for it anyway. Maybe add another logic or sumthin. In the mean time i stick with SQLite cuz im literally halfway through my project. Then after i finished it i move to SQL Server entirely

Patch 3.25.17.25 : 
- So ive been thinking lets just drop the foreign key in the out_stock_log table for now. Not because i dont value integrity but the damn system is fighting back at me. But instead when im restoring a transaction. 
- If lets say the stockid in out_stock_log dont exist in stock_log table. Well the restoration wont happen. No imaginary restoration. But it will came at a cost the business logic will get longer but thats okat ill include that at the readme file explaining why the it took a longer route due to the limitation of SQLite itself.
- Addeda custom helper function to create new stockentity from the array.
- To sum it up ive made some progress on the "remove" logic on stock transaction. It will need some workaround such as added business logic on restoration part there wont be a "ghost restoration"