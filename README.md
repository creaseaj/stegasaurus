# Stegasaurus
## Notion
This project is using notion to help manage tickets and sprints. To view the current sprint, along with previous ones and the project's progress, [click here](https://stegasaurus.notion.site/Project-State-577874af1cb542309b7066f52f9c30a6).
## Project Vision

This is for malware researchers and people searching for signs of steganography who want to investigate images to help identify the presence of malware and hidden communications. Stegasaurus is a web app that provides a toolkit for steganography and steganalysis which provides a unified user interface across different devices, allowing for investigations to be conducted collaboratively across the internet.


## Risks

Synchronisation feature to allow people to see updates on other devices could take longer to implement than planned.

*Implement this feature using API calls instead of sockets to reduce the complexity of the feature, because an API library will already need to be configured.*

---

Session keys are improperly stored.

*This could result that session keys are exposed to other users and accessed to imitate other people. This can be fixed by configuring the cookies to not be accessible by the browser.*

---

Steganalysis Implementation can take longer due to the packages available

*This could result that the Steganalysis implementation will go into another sprint. Because these features are essential a less important sprint will be removed to ensure that a quality core to the project is present.*

---