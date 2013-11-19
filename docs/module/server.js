//This is a super simple router and server
//It works for browsing the unbuilt docs, but it contains no
//proper error handling, security or other things you might expect
//from a full fledged server
//
//to start the server use:
//>node server.js
//
//then point your browser to:
//http://locahost

var http = require('http'),
    fs = require('fs'),
    url = require('url'),
    Twig = require(__dirname + '/../../vendor/twig/twig'),
    file,
    packages = [
        'dojo',
        'dijit',
        'havok',
        'mystique'
    ],
    respond = function(request, response, content, contentType){
        response.writeHeader(200, {"Content-Type": contentType});
        response.write(content);
        response.end();
        console.log('Response sent for ' + request.url);
    };

http.createServer(function(request, response) {
    var urlObj = url.parse(request.url, true),
        filePieces = urlObj.pathname.split('.'),
        fileType = filePieces.pop(),
        pathPieces = urlObj.pathname.split('/'),
        contentType = 'text/html',
        params = urlObj.query ? urlObj.query : {};

    if (!params.theme) params.theme = 'zoop';
    params.settings = {views: __dirname + '/../src/'};

    if (packages.indexOf(pathPieces[1]) != -1){
        fs.readFile(__dirname + '/../../../' + request.url, function (err, content) {
            if (err) {
                throw err;
            }
            respond(request, response, content, 'text/javascript');
        })
    } else if (fileType == 'html') {
        if (pathPieces[1] == 'api') {

            var template,
                json,
                i;

            if (filePieces[filePieces.length - 1].indexOf('-content') != -1){
                //return content only
                filePieces[filePieces.length - 1] = filePieces[filePieces.length - 1].replace('-content', '');
                template = 'doc-content.twig';
            } else {
                //return full page
                template = 'doc.twig';
            }

            var jsonParams = require(__dirname + '/../src/' + filePieces.join('.') + '.json');
            for (i in jsonParams){
                params[i] = jsonParams[i];
            }
            Twig.renderFile(__dirname + '/../src/api/' + template, params, function (err, content) {
                if (err) {
                    throw err;
                }
                respond(request, response, content, contentType);
            })
        } else {
            Twig.renderFile(__dirname + '/../src/' + filePieces.join('.') + '.twig', params, function (err, content) {
                if (err) {
                    throw err;
                }
                respond(request, response, content, contentType);
            })
        }
    } else {
        switch (fileType){
            case 'png':
                contentType = 'image/png';
                break;
            case 'js':
                contentType = 'text/javascript';
                break;
            case 'css':
                contentType = 'text/css';
                break;
        }
        fs.readFile(__dirname + '/../src/' + request.url, function (err, content) {
            if (err) {
                throw err;
            }
            respond(request, response, content, contentType);
        })
    }
}).listen(80, '127.0.0.1');

console.log("Server running at http://127.0.0.1:80/");
