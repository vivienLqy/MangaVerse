import React, { useState } from 'react';
import Logo from "../../assets/Logo.svg";
import { NavLink } from 'react-router-dom';

const NavAdmin = () => {
    const [showDropdown, setShowDropdown] = useState(false);

    const toggleDropdown = () => {
        setShowDropdown(!showDropdown);
    };

    return (
        <div className='flex w-1/6 bg-nav'>
            <div className="flex-grow h-5-100 flex flex-col justify-around">
                <div>
                    <NavLink to="/" className="flex items-center flex-col text-white">
                        <img className="w-16 h-16 ml-5 " src={Logo} alt="logo" />
                        <p>MangasVerse</p>
                    </NavLink>
                </div>
                <div className=''>
                    <ul>
                        <li className='bg-lavande p-2'>
                            <NavLink to="/" className="flex items-center flex-col text-white text-2xl">
                                <p>Dashboard</p>
                            </NavLink>
                        </li>
                        <li className='bg-lavande p-2'>
                            <div onClick={toggleDropdown} className="flex items-center flex-col text-white cursor-pointer relative">
                                <div className='flex flex-row'>
                                    <NavLink to="/dashboard" className="flex items-center flex-row text-white text-2xl">
                                        <p>Produits</p>
                                        <span className={`ml-1 transform ${showDropdown ? '0' : 'rotate-90'} transition duration-300 ease-in-out`}>&#9660;</span>
                                    </NavLink>
                                </div>
                                {showDropdown && (
                                    <ul className="text-white absolute top-full left-50 mt-2 text-center text-sm">
                                        <li className='hover:underline'>
                                            <NavLink to="/produits" className="flex items-center flex-col text-white">
                                                <p>Categories</p>
                                            </NavLink>
                                        </li>
                                        <li className='hover:underline'>
                                            <NavLink to="/produits" className="flex items-center flex-col text-white">
                                                <p>Types</p>
                                            </NavLink>
                                        </li>
                                    </ul>
                                )}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    );
};

export default NavAdmin;
