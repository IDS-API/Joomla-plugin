<?php
//******************************************************************************
//* $Id:: eldisapi.php 133 2011-12-26 09:54:14Z subhendu                 $
//* $Revision:: 133                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 15:24:14 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/
?>
<h3>Eldis Open API Documentation</h3>

<p><b>Documentation</b><br>
The IDS web API helps programmers to use data and metadata contained in the datasets - BRIDGE and ELDIS - maintained by IDS. The API can be used to search or retrieve the metadata about an object stored in the IDS datasets.</p>

<p><b>Overview</b><br>
The Eldis search API is a HTTP service in a REST style architecture. It allows search of datacore assets based upon a query and a number of meta-data criteria. It also allows search of the category hierarchy within the datacore. Data is returned as either JSON or XML and asset records can be returned in a number of formats including short form and full form.</p>

<p><b>Authentication</b><br>
In order to successfully use the API, users are required to sign up with a Unique ID. It is required that these tokens are sent with every request within the HTTP header. To register for an API key visit <a href="http://api.ids.ac.uk/accounts/register/">http://api.ids.ac.uk/accounts/register/</a>
</p>

<p>For more API details please visit <a href="http://api.ids.ac.uk/docs">http://api.ids.ac.uk/docs</a></p>

