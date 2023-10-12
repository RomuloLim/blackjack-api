![RomuloLim Blackjack-API](https://preview.dragon-code.pro/Romulo-lima/Blackjack-API.svg?brand=laravel&season=disabled&mode=auto)

<p align="center">🪙💰 A fun API for playing blackjack with your friends 💰🪙</p>

<p align="center">
  <a href="#%EF%B8%8F-about-the-project">About the project</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-technologies">Technologies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-getting-started">Project Installation</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-how-to-contribute">How to contribute</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-license">License</a>
</p>

## 💇🏻‍♂️ About the project

This API contains routes to authenticate users and room owners, create rooms, join rooms, and play blackjack with your friends.

## 🚀 Technologies

Technologies that I used to develop this API

<img src="https://img.shields.io/badge/laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=fff&labelColor=FF2D20" />
<img src="https://img.shields.io/badge/postgres-0064a5?style=for-the-badge&logo=postgresql&logoColor=fff&labelColor=0064a5" />

## 📖 External API
This project uses the [Deck of Cards API](https://deckofcardsapi.com/) to generate the cards.

## 💻 Project Installation

### Requirements

- [Docker](https://www.docker.com/)

**Installation Steps**
Clone the repository
```sh
git clone https://github.com/RomuloLim/blackjack-api.git
```

```sh
cd blackjack-api
```

Start containers with Sail
```sh
./vendor/bin/sail up -d
```

[//]: # (Install dependencies and perform project)

[//]: # (```sh)

[//]: # (./vendor/bin/sail composer install)

[//]: # (./vendor/bin/sail artisan key:generate)

[//]: # (./vendor/bin/sail artisan migrate)

[//]: # (./vendor/bin/sail artisan db:seed)

[//]: # (```)

## 🤔 How to contribute

**Make a fork of this repository**

```bash
# Fork using GitHub official command line
# If you don't have the GitHub CLI, use the web site to do that.

$ gh repo fork RomuloLim/blackjack-api
```

**Follow the steps below**

```bash
# Clone your fork
$ git clone your-fork-url && cd blackjack-api

# Create a branch with your feature
$ git checkout -b my-feature

# Make the commit with your changes
$ git commit -m 'feat: My new feature'

# Send the code to your remote branch
$ git push origin my-feature
```

After your pull request is merged, you can delete your branch

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Made with 💜 &nbsp;by Rômulo Lima 👋 &nbsp;[See my linkedin](https://www.linkedin.com/in/romulolim/)
