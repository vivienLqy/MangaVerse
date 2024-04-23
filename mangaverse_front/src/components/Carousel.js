import React, { useState, useEffect } from "react";

const Carousel = () => {
  // State pour suivre l'index de la diapositive actuelle
  const [currentIndex, setCurrentIndex] = useState(0);
  const [isLargeScreen, setIsLargeScreen] = useState(false);

  const images = [
    "/img/manga/onepiece/OpT1.jpg",
    "/img/manga/onepiece/OpT2.jpg",
    "/img/manga/onepiece/OpT3.jpg",
    "/img/manga/onepiece/OpT4.jpg",
    "/img/manga/onepiece/OpT5.jpg",
    "/img/manga/onepiece/OpT6.jpg",
  ];

  // Fonction pour passer à la diapositive suivante
  const nextSlide = () => {
    // Si nous sommes à la dernière diapositive, revenons à la première
    setCurrentIndex((prevIndex) =>
      prevIndex === images.length - 3 ? 0 : prevIndex + 1
    );
  };

  useEffect(() => {
    const handleResize = () => {
      setIsLargeScreen(window.innerWidth >= 1024);
    };
    handleResize();
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  // Fonction pour passer à la diapositive précédente
  const prevSlide = () => {
    // Si nous sommes à la première diapositive, allons à la dernière
    setCurrentIndex((prevIndex) =>
      prevIndex === 0 ? images.length - 3 : prevIndex - 1
    );
  };

  return (
    <div className="relative w-2/4">
      {/* Conteneur pour les diapositives */}
      <div className="flex justify-center">
        <div className="w-full">
          {/* Flexbox pour espacer les images */}
          <div className="flex justify-around">
            {/* Afficher seulement les 3 images actuellement visibles */}
            {images
              .slice(currentIndex, currentIndex + (isLargeScreen ? 3 : 1))
              .map((image, index) => (
                <div
                  key={index}
                  className={`w-full h-full flex justify-center items-center transition-opacity duration-500`}
                >
                  {/* Affichage de l'image */}
                  <img
                    src={image}
                    alt={`Slide ${index + currentIndex + 1}`}
                    className="object-cover w-48 h-full"
                  />
                </div>
              ))}
          </div>
        </div>
      </div>

      {/* Contrôles pour passer aux diapositives précédentes et suivantes */}
      <button
        onClick={prevSlide}
        className="absolute top-1/2 -translate-y-1/2 left-0 z-10 bg-gray-800/50 text-white rounded-full p-2"
      >
        {"<"}
      </button>
      <button
        onClick={nextSlide}
        className="absolute top-1/2 -translate-y-1/2 right-0 z-10 bg-gray-800/50 text-white rounded-full p-2"
      >
        {">"}
      </button>
    </div>
  );
};

export default Carousel;
