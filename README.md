---

# JSON Data Manipulation Project

This project demonstrates how to manipulate JSON data using Laravel. It fetches JSON data from two sources, manipulates it according to specified requirements, and then presents the manipulated data in a new structure.

## Getting Started

Follow these steps to set up and run the project:

### Prerequisites

- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/downloads)
- [PHP](https://www.php.net/manual/en/install.php)

### Installation

1. Clone the project repository:

```bash
git clone https://github.com/mhdtaufikr/Project2.git
```

2. Navigate to the project directory:

```bash
cd Project2
```

3. Install the project dependencies using Composer:

```bash
composer install
```

### Usage

1. Start the Laravel development server:

```bash
php artisan serve
```

2. Open Postman or any other API testing tool.

3. Make a GET request to the following URL:

```
http://127.0.0.1:8000/api/newStructure
```

This endpoint will return the manipulated JSON data in the new structure.

### What's Happening

- The project manipulates JSON data from two different sources and restructures it according to specified requirements.
- The manipulated data is sorted based on the `ahass_distance` field in ascending order.

## Credits

This project was created as part of the Nawatech PHP Developer Coding Test.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

You can customize the README further by adding more details, such as API documentation, additional setup instructions, and any other relevant information about the project. Remember to replace placeholders with actual content as needed.