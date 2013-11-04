//This is a super simple router and server
//It works for browsing the unbuilt docs, but it contains no
//proper error handling, security or other things you might expect
//from a full fledged server
//
//to start the server use:
//>node server.js

var http = require('http'),
    fs = require('fs'),
    Twig = require(__dirname + '/../vendor/twig/twig'),
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
    var filePieces = request.url.split('.'),
        fileType = filePieces.pop(),
        pathPieces = request.url.split('/'),
        contentType = 'text/html';

    if (packages.indexOf(pathPieces[1]) != -1){
        fs.readFile(__dirname + '/../../../' + request.url, function (err, content) {
            if (err) {
                throw err;
            }
            respond(request, response, content, 'text/javascript');
        })
    } else if (fileType == 'html') {
        Twig.renderFile(__dirname + filePieces.join('.') + '.twig', {settings: {views: __dirname}}, function (err, content) {
            if (err) {
                throw err;
            }
            respond(request, response, content, contentType);
        })
    } else {
        switch (fileType){
            case 'js':
                contentType = 'text/javascript';
                break;
            case 'css':
                contentType = 'text/css';
                break;
        }
        fs.readFile(__dirname + request.url, function (err, content) {
            if (err) {
                throw err;
            }
            respond(request, response, content, contentType);
        })
    }
}).listen(80, '127.0.0.1');

console.log("Server running at http://127.0.0.1:80/");
