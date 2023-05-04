console.log("this is my js file");
//f33d247c81304328aef7c8f07e4bbbb7

// let source='bbc-news';
// let apiKey='b29e32d951ccb4a08f00c22e808185a6'
let newsAccordion=document.getElementById('newsAccordion');

let apiKey='d016dc66749712122f7c80e5f85cfdf3'



const xhr=new XMLHttpRequest();
///xhr.open('GET', `https://newsapi.org/v2/top-headlines?sources=${source}&apiKey=${apiKey}`, true);
xhr.open('GET',` https://gnews.io/api/v4/top-headlines?token=${apiKey}&topic=breaking-news`,true);

xhr.onload=function(){
    if(this.status===200){
        let json=JSON.parse(this.responseText);
        let articles=json.articles;
         console.log(articles);
        let newsHtml="";
        articles.forEach(function(element,index){
          let news=`  <div class="card"  style="width:70%;">
                            <div class="card-header" id="heading${index}">
                            <div id="butt">
                            <button class="btn btn-link collapsed "  type="button" data-toggle="collapse" data-target="#collapse${index}"
                            aria-expanded="true" aria-control="collapse${index}" >
                            <b>Headline-${index+1}:</b> ${element["title"]}
                            </button>
                            </div>
                            </div>
                            <div id="collapse${index}" class="collapse " aria-labelledby="heading${index}" data-parent="#newsAccordion">
                              <div class="card-body">
                              ${element["content"]}.<a href="${element['url']}"  target="_blank">Read more here..</a>
                              </div>
                            </div>
                      </div>`;
            newsHtml+=news;
          });
        newsAccordion.innerHTML=newsHtml;
     }else{
        console.log("some error occured");
    }
  }

  xhr.send()

