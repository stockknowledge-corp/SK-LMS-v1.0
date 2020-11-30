"use strict";

const api_url = 'http://127.0.0.1:5500/index.html';

var init = { method: 'GET',
                headers: {
                        'Content-Type': 'application/json'
                },
                mode: 'cors',
                cache: 'default'
            };

let myRequest = new Request(api_url, init);

async function getData()
{
    try
    {
        const response = await fetch(myRequest);
        const data = await response.json();

        console.log(data);
    }
    catch(error)
    {
        console.log(error);
    }
}

getData();