$("#add").click(function() {
    var treeList = $("a");
    console.log('treeList', treeList);
});

var auditPaperList = [];
var activePdf = '';
var arrayCollection = [
    {"id": "0.1", "parent": "#", "text": "প্রথম পৃষ্ঠা"},
    {"id": "0.2", "parent": "#", "text": "সূচিপত্র"},
    {"id": "1", "parent": "#", "text": "১.০ ভূমিকা"},
    {"id": "1.1", "parent": "1", "text": "১.১ পটভূমি"},
    {"id": "1.2", "parent": "1", "text": "১.২ এনটিটি'র নাম"},
    {"id": "1.3", "parent": "1", "text": "১.৩ নিরীক্ষার ধরণ"},
    {"id": "2", "parent": "#", "text": "২.০ প্রতিষ্ঠান পরিচিতি"},
    {"id": "2.1", "parent": "2", "text": "২.১ ভূমিকা"},
    {"id": "2.2", "parent": "2", "text": "২.২ অর্গানরগ্রাম"},
    {"id": "2.3", "parent": "2", "text": "২.৩ সুপ্রীম কোর্টের মিশন"},
    {"id": "2.4", "parent": "2", "text": "২.৪ সাংগঠনিক কাথামো/জনবল"},
    {"id": "2.5", "parent": "2", "text": "২.৫ সুপ্রীম কোর্টের কার্যাবলী"},
    {"id": "2.6", "parent": "2", "text": "২.৬ প্রধান কর্মকৃতি"},
];


$('#newAudit').jstree({
    "core" : {
        "check_callback" : true,
        'data': arrayCollection
    },
    "plugins": ["dnd","checkbox", "search"] 
});

for (let i = 0; i < arrayCollection.length; i++) {
    var arrayData = {"id" : arrayCollection[i].id, "title" : arrayCollection[i].text, "content" : ""  }
    auditPaperList.push(arrayData);
    var dataHtml = '<div class="pdf-screen"><p class="pageTileNumber">'+ arrayCollection[i].text+'</p><div id="pdfContent'+arrayCollection[i].id+'"></div></div>';
    $("#writing-screen-wrapper").append(dataHtml);
}

$('#newAudit').on("select_node.jstree", function (e, data) { 
    activePdf = data.node.id;
    console.log('activePdf', activePdf);
});

$('.summernote').summernote({
    height: 600,
    callbacks: {
        onChange: function(contents, arrayCollection) {
           console.log(activePdf);
           for (let i = 0; i < arrayCollection.length; i++) {
               if (arrayCollection[i].id == '1') {
                   alert();
               }
           }
        }
    }
});



