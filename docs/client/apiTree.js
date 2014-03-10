define([
    'dojo/Deferred',
    'dojo/store/Memory'
],
function(
    Deferred,
    Memory
){
    var result = new Deferred;
    require(['dojo/text!docs/api-tree-data.json'], function(data){
        result.resolve(new Memory(JSON.parse(data)));
    })
    return result;
});
