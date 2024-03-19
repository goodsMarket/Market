import { styled } from "styled-components";

export const Box = styled.div`
display: flex;
flex-direction: column;
width: 100%;
`;

export const TabBox = styled.div`
display: flex;
background-color:#F7F7F7;
`;

export const TabButton = styled.button`
border: none;
width: 50%;
height: 60px;
font-size : 1.2rem;
font-weight: bold;
box-sizing: border-box;
border-bottom: ${({ "data-active": dataActive }) =>
        dataActive === "true" ? "3px solid #13B9EE" : "transparent"};
background-color: ${({ "data-active": dataActive }) =>
        dataActive === "true" ? "#ffffff" : "transparent"};
color: ${({ "data-active": dataActive }) =>
        dataActive === "true" ? "#13B9EE" : "#B7B7B7"};
cursor: pointer;
`;

export const TabContent = styled.div`
padding: 10px;
`;