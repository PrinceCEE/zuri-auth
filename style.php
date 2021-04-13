<style>
  /**Adding all the css on a single file */
  body {
    background-color: teal;
    color: white;
  }

  .container {
    max-width: 720px;
    margin: 5% auto;
    display: flex;
    justify-content: center;
  }

  .container>div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  form div {
    margin-bottom: 20px;
  }

  form div label {
    display: block;
  }

  form input {
    width: 400px;
    height: 35px;
    border: none;
    border-radius: 5px;
  }

  form textarea {
    width: 400px;
    border: none;
    border-radius: 5px;
  }

  form a,
  div a {
    color: white;
  }

  button {
    color: teal;
    background-color: white;
    border: 2px solid teal;
    padding: 10px 0;
    border-radius: 5px;
    cursor: pointer;
    width: 100px;
  }

  .container #index h3 {
    margin: 0px;
    letter-spacing: 3px;
  }

  .container #index h3+p {
    margin: 0px;
  }

  p.error {
    color: white;
    background-color: red;
    text-align: center;
    border-radius: 5px;
    font-size: large;
    margin-top: 20px;
    padding: 10px;
  }
</style>