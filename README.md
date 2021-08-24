ValorantWidget
====
"ValorantWidget" is widget shows current valorant rank and rank rating for streamers.
![image](https://user-images.githubusercontent.com/25396805/130334416-94e153ce-b180-4772-991f-09e3033582aa.PNG)  
![addWL](https://user-images.githubusercontent.com/25396805/130539211-1f5688dd-45bb-47c3-8b3d-f7e6a7bbd2a2.PNG)  

## 日本語
[\[日本語版はこちら\]](README_JP.md)

## Terms of Use / Disclaimer
This tool is not affiliated with Riot Officials in any way.  
All use is at the user's own risk.  
The developer and the development community assume no responsibility for any problems, damages, or other issues that may arise from the use of this system.  

## Update Information
|  Date  |  Description  |
| ---- | ---- |
|  2021.08.24  |  Add automatic W/L recording function  |

## Features
The tool can be run only on the user's PC after downloading it.  
The username and password required for use is communicated only between the user and Riot.  
It has always been developed as open source, and the developers and the development community are committed to protecting the security of the users.  

The widgets to be output to distribution tools such as OBS are provided as HTML/CSS templates, and can be  
Users can customize them themselves.  
For security reasons, please always use the default template or the one available at [VW-template](https://github.com/nolldayo/VW-template).  
The default and [VW-template](https://github.com/nolldayo/VW-template) templates are always checked for security by the developer and the developer community before being released to the public.  

## How to install
I am currently preparing a video on how to install it.  
If you do not know how to install it, please contact us at [Twitter](https://twitter.com/YNZjp).  

To use the tool, you need to have a PHP environment set up on Windows.  
If you have already installed it, please skip this introduction section.  
If you don't know what the above means, you must not have it set up, so please follow the steps below.  

**1. Install PHP**  
You will need to add PHP to your Windows environment variables.  
If you can install it manually, please do so.  
The following steps are the easiest way to install XAMPP.  

Go to the official page of [XAMPP](https://www.apachefriends.org/jp/index.html) and install the installer for Windows.  
![xampp](https://user-images.githubusercontent.com/25396805/130334532-b034c8c5-daa2-4491-aa5a-b2dd8c4f13ec.PNG)  
Press "Next" for everything and let the wizard finish.  
![x1](https://user-images.githubusercontent.com/25396805/130334628-9fb6d6cd-0f4e-4306-8fe1-9b0344addfff.PNG)  
You can uncheck the "Do you want to start the Control Panel now?"  
![x2](https://user-images.githubusercontent.com/25396805/130334643-c4626eff-19ad-490f-8314-c53785861bed.jpg)  

With the installation of XAMPP the PHP configuration needed to use the tool is automatically completed.  

**2. Download the Valorant Widget**  
Clone the file from this Github.  
If you don't know how to use it, click the green "Code" button on this page, and you will see "Download ZIP".  
![dl](https://user-images.githubusercontent.com/25396805/130334720-2bf1e35b-ad70-4e83-821a-acfd0d65c2f6.PNG)  

**3. Set up the Valorant Widget**  
When you unzip the downloaded ZIP, you will see a folder like the following  
![v1](https://user-images.githubusercontent.com/25396805/130334759-6bbce760-9d8e-45a0-b4af-c9bb0bb01864.PNG)  

First, you need to set up your user name and password. Open the "setting.txt" file and set them as follows  
"Please note that the username is different from the Valorant username."  
"password=Riot's password."  
"server=Refer to the server list. If you are in NA, use na".  
![v2](https://user-images.githubusercontent.com/25396805/130334797-d63702b1-b695-4eff-a50a-8dd3db99a688.PNG)  

Server list  
|  North America  |  Europe  |  Asia Pacific  |  Korea  |
| ---- | ---- | ---- | ---- |
|  na  |  eu  |  ap  |  kr  |

Your Valorant Widget setup is complete!  
Great job!  

**4. Launch the Valorant Widget**  
In the folder,  
「#ValorantWidget.bat」  
to start the program. If it is set up correctly, the following screen will appear and you can minimize it.  
![main](https://user-images.githubusercontent.com/25396805/130334923-228fbe94-3884-4b97-8613-4ec1f0978db7.PNG)  

As this is a self-made system, there is a possibility that anti-virus software will be activated when the rank information is saved in the PC.  
This tool is developed as open source on this Github project, and users can view the source code and check its safety.  
If you think it is safe, please allow it. After that, restart the tool and it will start working properly.  
![sec](https://user-images.githubusercontent.com/25396805/130334967-73e75a5b-9a14-45c5-8318-80d3daa47e6c.PNG)  

During streaming, **"#ValorantWidget.bat" must always be running.**  
At 30-second intervals, the latest rank tier and rank rating will be checked and the data for output will be updated.  

**5. Set the html file for output to OBS**  
(The explanation in Streamlabs OBS)  

First, please select Add Browser Source from Add Source.  
![o1](https://user-images.githubusercontent.com/25396805/130335170-a2c344c7-4628-47c9-8cd4-4da47f43eccc.PNG)  
![o2](https://user-images.githubusercontent.com/25396805/130335177-33fe55d4-6492-4050-aaf7-ce5cd273ded7.PNG)  

Since we need to load a local HTML file, check Local File, and click Browse.  
Add "#template" > **"output.html"** in the ValorantWidget folder.  
![o3](https://user-images.githubusercontent.com/25396805/130335180-8afcc20b-1585-456a-b995-02e68f3fe2d4.PNG)  
![o4](https://user-images.githubusercontent.com/25396805/130335220-812b8b8f-186e-47c7-b111-28c6c1a2616f.PNG)  

Set the width to 700, height to 200, and  
Check the "Refresh the browser when a scene is active" checkbox and press Done.  
![o5](https://user-images.githubusercontent.com/25396805/130335224-75ebda04-2a38-4579-a06f-5108975c008d.PNG)  

The widget has been added!  
Automatic W/L display is described in the next section #6.  
The displayed widget can be enlarged, reduced, or moved as long as it does not interfere with the display. You can move it to the position you prefer.  
Initially, nothing is displayed, but if Step 3 is done correctly and "#ValorantWidget.bat" is always running, the widget will automatically display the current rank information.  
![o6](https://user-images.githubusercontent.com/25396805/130335265-2f3382f3-8ae2-4345-8f00-24a2838b8cbb.PNG)  

**6. Set the html file for W/L display to OBS**  
As for the W/L display, if you don't want to display it, please skip this section.  
Add outputWL.html from the browser source in the same way as registering the html for output above.  
Input size is **Width 150, Height 40**.  
W/L will be initialized every time "#ValorantWidget.bat" is invoked.  
In other words, the program will automatically record and display the W/L only during the delivery if you restart it every time you start the delivery.  

Thanks for the installation.  
From next time, please remember to **always start "#ValorantWidget.bat" when delivering.**  

## License
Users are free to use this tool for both personal and commercial use.  

## Author
If you have any questions or comments, please send them to Twitter.  

Twitter [@YNZjp](https://twitter.com/YNZjp)  
Youtube [YNZ](https://www.youtube.com/channel/UCn9l51qQWN6ZZHF-7AK01Gw)  
Twitch [YNZjp](https://www.twitch.tv/ynzjp)  

## Special Thanks
I would like to thank the following projects for their help in creating this project.  
I would like to express my sincere gratitude.  

[ValorantStreamOverlay by RumbleMike](https://github.com/RumbleMike/ValorantStreamOverlay)  
[Valorant App Developers](https://discord.gg/a9yzrw3KAm)  
[Valorant Font by brylark](https://www.reddit.com/r/VALORANT/comments/g0747t/valorant_font/)  

## Message to Riot
If you want to say anything to this project, Please contact my twitter.  
[@YNZjp](https://twitter.com/YNZjp)
