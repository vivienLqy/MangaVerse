import React from "react";
import Logo from "../../assets/Logo.svg";

const Footer = () => {
  return (
    <footer>
      <nav class="bg-nav h-16 w-full ">
        <div class="flex justify-around h-full items-center text-white">
          <div class="">
            <a href="/">
              <img src={Logo} className="w-16 h-12" alt="logo" />
            </a>
          </div>
          <div class="w-96">
            <ul class="hidden lg:flex w-full justify-between text-xs">
              <a href="/src/index.html">
                <li class="hovertext-lavande">Accueil</li>
              </a>
              <a href="#">
                <li class="hovertext-lavande">Catalogue</li>
              </a>
              <a href="#">
                <li class="hovertext-lavande">Contact</li>
              </a>
            </ul>
          </div>
          <p class="text-gray-500">
            Copyright ©2024 All rights reserved |{" "}
            <a href="" class="hovertext-lavande">
              Condition de confidentialité
            </a>
          </p>
        </div>
      </nav>
    </footer>
  );
};

export default Footer;
