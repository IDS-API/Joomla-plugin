/**
 * Changelog
 *
 * @package     Eldis Open API plugin
 * @version     1.6.01
 *
 * @author      
 * @copyright   
 * @license     See LICENSES.txt
 */
 
 
Documentation
==============
The IDS web API helps programmers to use data and metadata contained in the datasets - BRIDGE and ELDIS - maintained by IDS. The API can be used to search or retrieve the metadata about an object stored in the IDS datasets.


Overview
=========
The Eldis search API is a HTTP service in a REST style architecture. It allows search of datacore assets based upon a query and a number of meta-data criteria. It also allows search of the category hierarchy within the datacore. Data is returned as either JSON or XML and asset records can be returned in a number of formats including short form and full form.


Authentication
==============
In order to successfully use the API, users are required to sign up with a Unique ID. It is required that these tokens are sent with every request within the HTTP header. To register for an API key visit http://api.ids.ac.uk/accounts/register/ 


Rate limiting
=============
Users are currently limited to 30 HTTP requests per minute. Once this has been exceeded, users will receive an HTTP 400 response from the server.


Searching
==========
This allows the assets in the datacore to be searched. In order to search, users will need to specify the /search/ parameter after the base URL, and follow this with the query for that search (for example, to search for biofuels, /search/biofuels/etc..). Users are further able to filter the results by specifying a combination of the meta-data criteria below. Each of these should appear in the same /key/value/ format.


For more API details please visit http://api.ids.ac.uk/docs


Installation
=============
Please see INSTALL.TXT
	
	