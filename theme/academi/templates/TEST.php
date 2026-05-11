{{!
        This file is part of Moodle - http://moodle.org/

        Moodle is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        Moodle is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
    }}

    <nav id="header" class="{{^themestyleheader }} moodle-based-header {{/themestyleheader }} fixed-top navbar navbar-light bg-faded navbar-static-top navbar-expand moodle-has-zindex" aria-label="{{#str}}sitemenubar, admin{{/str}}">
        <div class="container-fluid navbar-nav">
                {{^themestyleheader  }} {{!-- Hide menu nave for moodle style }}
                    <button class="navbar-toggler aabtn d-block d-md-none px-1 my-1 border-0" data-toggler="drawers" data-action="toggle" data-target="theme_boost-drawers-primary">
                        <span class="navbar-toggler-icon"></span>
                        <span class="sr-only">{{#str}}sidepanel, core{{/str}}</span>
                    </button>
                    <a href="{{{ config.wwwroot }}}/?redirect=0" class="navbar-brand {{# logourl }}has-logo{{/ logourl }}
                        {{^ logourl }}
                            hidden-sm-down
                        {{/ logourl }}
                            ">
                        {{#showlogo}}
                            {{# logourl }}
                                <span class="logo">
                                    <img src="{{logourl}}" alt="{{sitename}}">
                                </span>
                            {{/ logourl }}
                            {{^ logourl }}
                                <span class="site-name hidden-sm-down">{{{ sitename }}}</span>
                            {{/ logourl }}
                        {{/showlogo}}
                        {{#showsitename}}
                            <span class="nav-site-name">{{{sitename}}}</span>
                        {{/showsitename}}
                    </a>
                {{/themestyleheader}}
                <a href="{{{ $CFG->wwwroot }}}/my" class="mobile-nav"><img src="https://ik.imagekit.io/036wrwwve/Moodle/logo%20only.png?updatedAt=1725988377074" alt="Logo" style="width: 40px;"/></a>
                <a href="{{{ $CFG->wwwroot }}}/my/courses.php" class="mobile-nav" style="font-size: 16px; padding: 0px 12px; color: white; margin-left: 8px;">My courses</a>
                <a href="{{{ $CFG->wwwroot }}}/my"><img class="customized_navbar_logo" src="https://ik.imagekit.io/036wrwwve/Moodle/rancho%20labs%20Logo%20White.png?updatedAt=1723615447090" alt="Logo"/></a>
                {{#themestyleheader  }} {{!-- Hide menu nave for moodle style }}
                    {{#primarymoremenu}}
                        <div class="primary-navigation">
                            {{> core/moremenu}}
                        </div>
                    {{/primarymoremenu}}

                    <ul class="navbar-nav d-none d-md-flex my-1 px-1">
                        <!-- page_heading_menu -->
                        {{{ output.page_heading_menu }}}
                    </ul>
                {{/themestyleheader}}

                <div id="usernavigation" class="navbar-nav ml-auto flex align-items-center ">
                <div id="xp-section" class="d-flex align-items-center mx-2">
                    <img  src="https://ilms-public.s3.ap-south-1.amazonaws.com/ilms-static-content/core-images/xp-black-white.svg" alt="xp Icon" style="width: 24px; margin-right: 8px;" />
                    <span id="xp-value" style="color:white;font-weight:bold">0</span>
                </div>
                <div id="coin-section" class="d-flex align-items-center mx-2" style="margin-right: 20px!important;">
                    <img  src="https://ilms-public.s3.ap-south-1.amazonaws.com/ilms-static-content/core-images/coin.svg" alt="Coin Icon" style="width: 24px; margin-right: 8px;" />
                    <span id="coin-value" style="color:white;font-weight:bold">0</span>
                </div>

                <div class="notification-icon" style="position: relative; cursor: pointer;" onclick="toggleNotificationPanel()">
                    <img src="https://img.icons8.com/?size=100&id=ftMXZGFfen2R&format=png&color=FFFFFF" alt="Notifications" style="width: 24px; margin:12px; margin-left:0px;" />
                    <span id="notification-count" style="opacity:0; position: absolute; top: 0; right: 0; background-color: red; color: white; font-size: 12px; border-radius: 50%; padding: 2px;width:20px; height:20px;display:flex; justify-content:center; align-items:center ">0</span>
                </div>    


                {{#langmenu}}
                    {{> theme_boost/language_menu }}
                {{/langmenu}}
                {{{ output.search_box }}}   
                {{{output.navbar_plugin}}}
                </div>
                <div class="d-flex align-items-stretch usermenu-container" data-region="usermenu">
                    {{#usermenu}}
                        {{> core/user_menu }}
                    {{/usermenu}}
                </div>
        
                {{{ output.edit_switch }}}
            </div>

        <!-- Notification Panel -->
        <div id="notification-parent" style="position:absolute;top:0;left:0;right:0;bottom:0;width:100vw;height:100vh;pointer-events:none">
               <div id="notification-panel" class="notification-panel" style="display: none; position: absolute; top: 60px; right: 20px; width: 300px; background-color: white; border: 1px solid #ccc; border-radius: 5px; z-index: 1000; max-height:400px; overflow-y:scroll" >
                    <div style="padding: 10px; text-align: center; font-weight: bold; border-bottom: 1px solid #ccc; background-color: #f7f7f7;">
                        My Notifications
                    </div>
                    {{! <div class="notification-header" style="display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">
                        <div style="flex: 1; text-align: center; cursor: pointer;" onclick="switchTab('all')" class="notification-tab active-tab">All</div>
                        <div style="flex: 1; text-align: center; cursor: pointer;" onclick="switchTab('mentions')" class="notification-tab">Mentions</div>

                    </div> }}
                    <div class="notification-content" id="all-notifications" style="position:relative;background-color:red">
                        <!-- All notifications will be rendered here -->
                    </div>
                    <div class="notification-content" id="mention-notifications" style="padding: 10px; display: none;">
                        <!-- Mention notifications will be rendered here -->
                    </div>
                    <button onclick="markAllAsRead()" style="position:sticky;bottom:0;left:0;width: 100%; padding: 10px; background-color: #233060; color: white; border: none; cursor: pointer;">Mark All Read</button>
                </div>
        </div>
            <!-- search_box -->
        </div>

        <script>
                //EVENT LISTENERS
                document.getElementById('notification-panel').addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                document.getElementById('notification-parent').addEventListener('click', function(e) {
                    closeNotificationPanel(e);
                });

                //GLOBAL VARIABLE
                const globalDataClient={};

                //FUNCTIONS DEFINITIONS
                function toggleNotificationPanel() {
                    const panel = document.getElementById('notification-panel');
                    const notificationParent=document.getElementById('notification-parent');
                    notificationParent.style.pointerEvents='all';
                    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                }
                function closeNotificationPanel(e) {
                    console.log(e);
                    e.stopPropagation();
                    const panel = document.getElementById('notification-panel');
                    const notificationParent=document.getElementById('notification-parent');
                    panel.style.display =  'none';
                    notificationParent.style.pointerEvents='none';
                }
                
                function switchTab(tab) {
                    const allTab = document.getElementById('all-notifications');
                    const mentionTab = document.getElementById('mention-notifications');
                    const allButton = document.querySelector('.notification-tab.active-tab');
                    
                    allButton.classList.remove('active-tab');
                    document.querySelector(`[onclick="switchTab('${tab}')"]`).classList.add('active-tab');
                    
                    if (tab === 'all') {
                        allTab.style.display = 'block';
                        mentionTab.style.display = 'none';
                    } else {
                        allTab.style.display = 'none';
                        mentionTab.style.display = 'block';
                    }
                }


          
                const  markAllAsRead = async ()=> {
                    console.log(globalDataClient);
                    if(!globalDataClient.token) return;
                    const notificationsRead=document.querySelectorAll('.notification-read-status');
                    console.log(notificationsRead);
                    try {
                        notificationsRead.forEach(e=>{
                            e.style.color='#2d98da';
                        })
                        for(let notification of globalDataClient.notifications){
                            // Make an API call to update each notification's isRead status
                            await fetch(`http://localhost:4000/api/users/markNotificationRead/${notification.notificationId}`, {
                                method: 'PUT', 
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Authorization': `Bearer ${globalDataClient.token}`
                                }
                            });
                        }

                        document.getElementById('notification-panel').style.display='none';
                        // Update the notification count
                        document.getElementById('notification-count').textContent = '';
                        document.getElementById('notification-count').style.display='none';
                        
                    } catch (error) {
                        console.error('Error marking notifications as read:', error);
                    }
                }

                function animateCoinValue(id, startValue, endValue) {
                    const duration = 1000; 
                    const startTime = performance.now();
                    const coinElement = document.getElementById(id);

                    function updateCoinValue(currentTime) {
                        const elapsedTime = currentTime - startTime;
                        const progress = Math.min(elapsedTime / duration, 1); 

                        const value = Math.floor(startValue + (endValue - startValue) * progress);
                        coinElement.textContent = value;

                        if (progress < 1) {
                            requestAnimationFrame(updateCoinValue); 
                        } else {
                            coinElement.textContent = endValue; 
                        }

                        if (value > startValue) {
                        }
                    }

                    requestAnimationFrame(updateCoinValue);
                }

                const generateToken = async () => {
                    try {
                        const res = await fetch('/getUser/index.php');
                        if (!res.ok) {
                            throw new Error('Failed to fetch token');
                        }
                        const data = await res.json();
                        return data;
                    } catch (error) {
                        console.error('Error generating token:', error);
                        return null;
                    }
                };

                const fetchStudentId = async (token) => {
                    try {
                        const response = await fetch('http://localhost:4000/api/users/studentidJWT', {
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`
                            },
                        });

                        if (!response.ok) {
                            throw new Error('Failed to fetch student ID');
                        }

                        const studentData = await response.json();
                        return studentData;
                    } catch (error) {
                        console.error('Error fetching student ID:', error);
                        return null;
                    }
                }; 

                //DOM FUNCTIONS
                function createNotificationContainerDiv(isRead){
                    const containerDiv=document.createElement('div');
                     // Apply styles to container
                    Object.assign(containerDiv.style, {
                        position:'relative',
                        padding: '12px',
                        fontSize:'16px',
                        backgroundColor: 'white',
                        boxShadow: '0 2px 10px rgba(0, 0, 0, 0.1)',
                        color: 'black',
                        fontFamily: 'Poppins, sans-serif',
                        borderBottom:'1px solid #ccc',
                        transition:'all 0.25s'
                    });
                    const svgIcon='<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check"><path d="M18 6 7 17l-5-5"/><path d="m22 10-7.5 7.5L13 16"/></svg>'
                    const span=document.createElement('span');
                    span.classList.add('notification-read-status')

                    const tickColor=isRead?'#2d98da':'#747d8c';
                    Object.assign(span.style,{
                        position:'absolute',
                        bottom:'8px',
                        right:'6px',
                        width:'18px',
                        height:'18px',
                        color:tickColor,
                    })
                    span.innerHTML=svgIcon;

                    containerDiv.appendChild(span);
                    return containerDiv;
                }

                function createParagraph(){
                    const p=document.createElement('p');
                     Object.assign(p.style, {
                        color: '#636e72',
                        marginBottom:'0px',
                        lineHeight:'18px'
                    });
                    return p;
                }

                function createCoinContainer(coins){
                    const div=document.createElement('div');
                    Object.assign(div.style,{
                        display:'flex',
                        alignItems:'center',
                        gap:'3px'
                    })
                    const span=document.createElement('span');
                     Object.assign(span.style, {
                        color: '#636e72',
                        fontWeight:"bold",
                        marginTop:'2px',
                    });
                    span.textContent=coins;
                    const image=document.createElement('img');
                    image.src='https://ilms-public.s3.ap-south-1.amazonaws.com/ilms-static-content/core-images/coin.svg';
                     Object.assign(image.style, {
                        width:"20px",
                        height:"20px",
                        objectFit:'contain',
                    });
                    div.appendChild(image);
                    div.appendChild(span);
                    return div;
                }
                
                function createXpContainer(xp){
                    const div=document.createElement('div');
                    Object.assign(div.style,{
                        display:'flex',
                        alignItems:'center',
                        gap:'3px'
                    })
                    const span=document.createElement('span');
                     Object.assign(span.style, {
                        color: '#636e72',
                        fontWeight:"bold",
                        marginTop:'2px',
                    });
                    span.textContent=xp;
                    const image=document.createElement('img');
                    image.src='https://ilms-public.s3.ap-south-1.amazonaws.com/ilms-static-content/core-images/xp-black-white.svg';
                     Object.assign(image.style, {
                        width:"28px",
                        height:"28px",
                        objectFit:'contain',
                    });
                    div.appendChild(image);
                    div.appendChild(span);
                    return div;
                }

                function createNotification(notification){
                    const event=notification.event;
                    const message=notification.message;
                    switch(event){
                        case 'PROJECT_APPROVED':{
                            /*
                                message:{
                                    projectId:"",
                                    projectTitle:""
                                }
                            */
                            const containerDiv = createNotificationContainerDiv(notification.isRead);
                                
                                // Create inner content div
                                const contentDiv = document.createElement('div');

                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML = `<span style="font-size:24px">🥳</span> Your project <strong>${message.projectTitle}</strong> has been approved!`;

                                // Create link
                                const link = document.createElement('a');
                                link.href = `http://localhost:3000/community/project_page/${message.projectId}`;
                                link.textContent = 'View Project';
                                
                                // Apply styles to link
                                Object.assign(link.style, {
                                    color: '#2d3436',
                                    textDecoration: 'none',
                                    transition: 'color 0.3s ease',
                                    borderBottom:'2px solid #2d3436',
                                });

                                // Add hover effect
                                link.addEventListener('mouseover', () => {
                                    link.style.borderBottom='2px solid black';
                                    link.style.color='black';
                                });

                                link.addEventListener('mouseout', () => {
                                    link.style.color= '#2d3436',
                                    link.style.borderBottom='2px solid #2d3436';
                                });

                                // Assemble the component
                                contentDiv.appendChild(paragraph);
                                contentDiv.appendChild(link);
                                containerDiv.appendChild(contentDiv);

                                return containerDiv;

                        }
                        case 'ACHIEVEMENT_UNLOCKED':{
                                /*
                                    message:{
                                        achievementName:"",
                                        badgeUrl:"",
                                        achievementCompleted:boolean,
                                        rewardCoins:number,
                                        rewardXp:number,
                                        level:number
                                    }
                                */
                                const containerDiv = createNotificationContainerDiv(notification.isRead);

                                // Create inner content div
                                const contentDiv = document.createElement('div');

                                const upperDiv=document.createElement('div');
                                Object.assign(upperDiv.style, {
                                    display:'flex',
                                    alignItems:'center',
                                    gap:'4px',
                                    marginBottom:'4px',
                                });
                              
                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML = `Achievement Unlocked <br/> <strong>${message.achievementName} Level ${message.level}</strong> `;
                                

                                //create image to display badge
                                const badgeimage=document.createElement('img');
                                badgeimage.src=message.badgeUrl;
                                badgeimage.alt="badge"
                                
                                Object.assign(badgeimage.style, {
                                    width:"32px",
                                    height:"32px",
                                    objectFit:'contain',
                                });

                                // Assemble the component
                                upperDiv.appendChild(badgeimage);
                                upperDiv.appendChild(paragraph);

                                const bottomDiv=document.createElement('div');
                                Object.assign(bottomDiv.style, {
                                    display:'flex',
                                    alignItems:'center',
                                    gap:'8px'
                                });

                                const bottomParagraph=createParagraph();
                                bottomParagraph.textContent='You got!';


                                const coinContainer=createCoinContainer(message.rewardCoins);
                                const xpContainer=createXpContainer(message.rewardXp)

                                bottomDiv.appendChild(bottomParagraph);
                                bottomDiv.appendChild(coinContainer);
                                bottomDiv.appendChild(xpContainer);

                                contentDiv.appendChild(upperDiv);
                                contentDiv.appendChild(bottomDiv);
                                containerDiv.appendChild(contentDiv);

                                return containerDiv;
                        }
                        case 'STORY_APPROVED':{
                            /*
                                message:{
                                    storyId:"",
                                    storyTitle:""
                                }
                            */
                            const containerDiv = createNotificationContainerDiv(notification.isRead);
                                
                                // Create inner content div
                                const contentDiv = document.createElement('div');

                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML = `<span style="font-size:24px">🥳</span> Your Story <strong>${message.storyTitle}</strong> has been approved!`;

                                // Create link
                                const link = document.createElement('a');
                                link.href = `http://localhost:3000/community/project_page/${message.storyId}`;
                                link.textContent = 'View Story';
                                
                                // Apply styles to link
                                Object.assign(link.style, {
                                    color: '#2d3436',
                                    textDecoration: 'none',
                                    transition: 'color 0.3s ease',
                                    borderBottom:'2px solid #2d3436',
                                });

                                // Add hover effect
                                link.addEventListener('mouseover', () => {
                                    link.style.borderBottom='2px solid black';
                                    link.style.color='black';
                                });

                                link.addEventListener('mouseout', () => {
                                    link.style.color= '#2d3436',
                                    link.style.borderBottom='2px solid #2d3436';
                                });

                                // Assemble the component
                                contentDiv.appendChild(paragraph);
                                contentDiv.appendChild(link);
                                containerDiv.appendChild(contentDiv);

                                return containerDiv;

                        }
                         case 'PROJECT_REJECTED':{
                            /*
                                message:{
                                    projectId:"",
                                    projectTitle:""
                                }
                            */
                            const containerDiv = createNotificationContainerDiv(notification.isRead);
                                
                                // Create inner content div
                                const contentDiv = document.createElement('div');

                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML=`<span style="font-size:24px">😿</span> Your story has been rejected`

                                // Create link
                                const link = document.createElement('a');
                                link.href = `http://localhost:3000/community/project_page/${message.projectId}`;
                                link.textContent = 'View Project';
                                
                                // Apply styles to link
                                Object.assign(link.style, {
                                    color: '#2d3436',
                                    textDecoration: 'none',
                                    transition: 'color 0.3s ease',
                                    borderBottom:'2px solid #2d3436',
                                });

                                // Add hover effect
                                link.addEventListener('mouseover', () => {
                                    link.style.borderBottom='2px solid black';
                                    link.style.color='black';
                                });

                                link.addEventListener('mouseout', () => {
                                    link.style.color= '#2d3436',
                                    link.style.borderBottom='2px solid #2d3436';
                                });

                                // Assemble the component
                                contentDiv.appendChild(paragraph);
                                contentDiv.appendChild(link);
                                containerDiv.appendChild(contentDiv);

                                return containerDiv;
                        }

                        case 'STORY_REJECTED':{
                            /*
                                message:{
                                    storyId:"",
                                    storyTitle:""
                                }
                            */
                            const containerDiv = createNotificationContainerDiv(notification.isRead);
                                
                                // Create inner content div
                                const contentDiv = document.createElement('div');

                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML=`<span style="font-size:24px">😿</span> Your story has been rejected`

                                // Create link
                                const link = document.createElement('a');
                                link.href = `http://localhost:3000/community/project_page/${message.storyId}`;
                                link.textContent = 'View Story';
                                
                                // Apply styles to link
                                Object.assign(link.style, {
                                    color: '#2d3436',
                                    textDecoration: 'none',
                                    transition: 'color 0.3s ease',
                                    borderBottom:'2px solid #2d3436',
                                });

                                // Add hover effect
                                link.addEventListener('mouseover', () => {
                                    link.style.borderBottom='2px solid black';
                                    link.style.color='black';
                                });

                                link.addEventListener('mouseout', () => {
                                    link.style.color= '#2d3436',
                                    link.style.borderBottom='2px solid #2d3436';
                                });

                                // Assemble the component
                                contentDiv.appendChild(paragraph);
                                contentDiv.appendChild(link);
                                containerDiv.appendChild(contentDiv);

                                return containerDiv;
                        }
                        case 'NEW_COMPETITION':{
                                /*
                                    message:{
                                        competitionName:"",
                                        startDate:Date,
                                        endDate:Date,
                                        coverImage:"",
                                    }
                                */
                                const containerDiv = createNotificationContainerDiv(notification.isRead);

                                // Create inner content div
                                const contentDiv = document.createElement('div');
                                 Object.assign(contentDiv.style, {
                                    display:"flex",
                                    gap:'8px',
                                });

                                const leftDiv=document.createElement('div')
                                   //create image to display coverImage
                                const coverImage=document.createElement('img');
                                coverImage.src=message.coverImage;
                                coverImage.alt="coverImage"
                                
                                Object.assign(coverImage.style, {
                                    height:"48px",
                                    objectFit:'contain',
                                });
                                // Assemble the component
                                leftDiv.appendChild(coverImage);
                             

                                const rightDiv=document.createElement('div');
                                // Create paragraph with strong text
                                const paragraph = createParagraph();
                                paragraph.innerHTML = `<span style="font-size:22px">✨</span> You are now part of a new competition!
                                                        `;

                                const dateSection=createParagraph();
                                dateSection.style.fontSize='12px';
                                dateSection.style.lineHeight='14px';
                                dateSection.style.marginTop='6px';
                                dateSection.innerHTML=`<strong style="font-size:14px">
                                                            ${message.competitionName}
                                                        </strong>
                                                        <br/>
                                                        From ${message.startDate} to ${message.endDate}`;

                                rightDiv.appendChild(paragraph);
                                rightDiv.appendChild(dateSection);

                                contentDiv.appendChild(leftDiv);
                                contentDiv.appendChild(rightDiv);

                                containerDiv.appendChild(contentDiv);

                                return containerDiv;
                        }
                         case 'COMPETITION_GRADED':{
                                /*
                                    message:{
                                        competitionId:"",
                                        competitionName:"",
                                        rank:number,
                                        score:number,
                                        rewardCoins:number,
                                        rewardXp:number
                                    }
                                */
                                const containerDiv = createNotificationContainerDiv(notification.isRead);

                                // Create inner content div
                                const contentDiv = document.createElement('div');
                                 Object.assign(contentDiv.style, {
                                    display:"flex",
                                    flexDirection:'column',
                                    gap:'4px',
                                });

                                const upperDiv=document.createElement('div');
                                
                                const paragraph = createParagraph();
                                paragraph.innerHTML = `<span style="font-size:22px"></span> Result Announced For competition 
                                                        <strong style="font-size:14px">${message.competitionName}</strong>!
                                                        `;
                                upperDiv.appendChild(paragraph);


                                const bottomDiv=document.createElement('div');
                                Object.assign(bottomDiv.style,{
                                    display:'flex',
                                    alignItems:'center',
                                    gap:'4px'
                                })
                                const rewardMessage=createParagraph();
                                rewardMessage.textContent='You got!';

                                const coinContainer=createCoinContainer(message.rewardCoins);
                                const xpContainer=createXpContainer(message.rewardXp)
                                const scoreContainer=document.createElement('span');
                                scoreContainer.textContent=`Score: ${message.score}`
                                Object.assign(scoreContainer.style, {
                                    color: '#636e72',
                                    fontWeight:"bold",
                                    fontSize:'16px',
                                    marginTop:'2px',
                                });

                                bottomDiv.appendChild(rewardMessage);
                                bottomDiv.appendChild(coinContainer);
                                bottomDiv.appendChild(xpContainer);
                                bottomDiv.appendChild(scoreContainer);

                                contentDiv.appendChild(upperDiv);
                                contentDiv.appendChild(bottomDiv);

                                containerDiv.appendChild(contentDiv);

                                return containerDiv;
                        }
                        default:{
                            return document.createElement('div');
                        }
                    }
                    
                }              

                const initializeWebSocket = (token) => {
                
                    const ws = new WebSocket('ws://localhost:4001', ['Authorization', token]);

                    ws.onopen = () => {
                        console.log('WebSocket connection opened');
                    };

                    ws.onmessage = (event) => {
                        const data = JSON.parse(event.data);
                        console.log(data);
                        if (data.event === 'UPDATE_REWARDS') {
                            console.log(data.message);
                            const newCoinsValue = data.message.coins;
                            const coinElement = document.getElementById('coin-value');
                            const currentCoinsValue = parseInt(coinElement.textContent, 10);
                            animateCoinValue('coin-value', currentCoinsValue, newCoinsValue);

                            const newXPValue = data.message.xp;
                            const xpElement = document.getElementById('xp-value');
                            const currentXPValue = parseInt(xpElement.textContent, 10);
                            animateCoinValue('xp-value', currentXPValue, newXPValue);
                        }
                        else if (data.event === 'ALL_NOTIFICATIONS') {
                            const notifications=data.message.notifications;
                            globalDataClient.notifications=data.message.notifications;
                            const notificationBadge=document.getElementById('notification-count');
                            const unReadNotifications=notifications.filter(notification=>!notification.isRead).length;

                            if(unReadNotifications>0){
                                notificationBadge.style.opacity='1';
                                notificationBadge.textContent=unReadNotifications;
                            }

                            const notificationContentBox=document.getElementById('all-notifications');

                            notifications.forEach(notification=>{
                                const element=createNotification(notification);
                                console.log(element);
                                notificationContentBox.appendChild(element);
                            })
                        }                        
                    };
                    ws.onclose = () => {
                        console.log('WebSocket connection closed');
                    };

                    ws.onerror = (error) => {
                        console.error('WebSocket error:', error);
                    };
                };

                (async () => {
                    const tokenData = await generateToken();
                    if (tokenData) {
                        const studentData = await fetchStudentId(tokenData.token);
                        if (studentData) {
                            globalDataClient.token=studentData.jwtToken;
                            initializeWebSocket(studentData.jwtToken);
                        }
                    }
                })();
            
            
        </script>
    </nav>
    {{> theme_boost/primary-drawer-mobile }}